<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeaponListing;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Country;
use App\Models\User;
use App\Services\CurrencyConverter;

class CartController extends Controller
{
    public function index()
    {        
        $cartItems = Cart::where('user_id', Auth::id())
            ->where('status', 'open')
            ->with(['orders.weaponListing.weapon.weaponType', 'orders.weaponListing.weapon.country'])
            ->get();

        $converter = app('CurrencyConverter');
        $user = Auth::user();
        $selectedCountry = $user->country->name;

        $totalAmount = 0;
        $totalItems = 0;
        
        foreach ($cartItems as $cart) {
            foreach ($cart->orders as $order) {
                $order->local_price = $converter->convertWithSymbol($order->total_price, $selectedCountry);
                $order->unit_local_price = $converter->convertWithSymbol($order->weaponListing->price, $selectedCountry);
                
                $totalAmount += $order->total_price;
                $totalItems += $order->quantity;
            }
        }

        $totalLocalAmount = $converter->convertWithSymbol($totalAmount, $selectedCountry);

        return view('cart', compact('cartItems', 'totalAmount', 'totalItems', 'totalLocalAmount', 'selectedCountry')); 
    }
    public function addToCart(Request $request, $weaponListingId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $weaponListing = WeaponListing::findOrFail($weaponListingId);
        DB::transaction(function () use ($request, $weaponListing) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'status' => 'open'
            ]);

            Order::create([
                'cart_id' => $cart->id,
                'weapon_listing_id' => $weaponListing->id,
                'quantity' => $request->quantity,
                'total_price' => $weaponListing->price * $request->quantity,
            ]);

            $weaponListing->decrement('quantity', $request->quantity);
            
            if ($weaponListing->quantity <= 0) {
                $weaponListing->update(['is_available' => false]);
            }
        });

        return redirect()->route('weapons.index')->with('success', 'Weapon added to cart.');

    }

    public function remove($id)
    {
        $order = Order::findOrFail($id);
        
        $cart = Cart::where('user_id', Auth::id())->where('id', $order->cart_id)->first();
        
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Unauthorized action.');
        }

        $order->weaponListing->increment('quantity', $order->quantity);
        $order->weaponListing->update(['is_available' => true]);
        
        $order->delete();
        
        if ($cart->orders()->count() === 0) {
            $cart->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully.');
    }

    public function clear()
    {
        $carts = Cart::where('user_id', Auth::id())->where('status', 'open')->get();
        
        foreach ($carts as $cart) {
            foreach ($cart->orders as $order) {
                $order->weaponListing->increment('quantity', $order->quantity);
                $order->weaponListing->update(['is_available' => true]);
            }
            $cart->delete();
        }
        
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');  
    }
    public function checkout(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'open')
            ->with('orders.weaponListing')
            ->firstOrFail();
        if(Auth::user()->cash < $cart->orders->sum('total_price')) {
            return redirect()->route('cart.index')->with('error', 'Insufficient funds to complete the order.');
        }

        DB::transaction(function () use ($cart) {
            foreach ($cart->orders as $order) {
                if (!$order->weaponListing->is_available || 
                    $order->weaponListing->quantity < $order->quantity) {
                    return redirect()->route('cart.index')->with('error', "Item {$order->weaponListing->weapon->name} is no longer available");
                }
            }

            $cart->update(['status' => 'submitted']);
            $user = User::findOrFail(Auth::id());
            $user->decrement('cash', $cart->orders->sum('total_price'));
            $user->save();
            
        });

        $this->clear();
        
        return redirect()->route('cart.index')->with('success', 'Order placed successfully.');
    }
    
}
