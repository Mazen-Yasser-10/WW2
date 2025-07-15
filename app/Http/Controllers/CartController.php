<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeaponListing;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;


class CartController extends Controller
{
    public function index()
    {        
        $cartItems = Cart::where('user_id', Auth::id())
            ->where('status', 'open')
            ->with(['orders.weaponListing.weapon.weaponType', 'orders.weaponListing.weapon.country'])
            ->get();

        $totalAmount = 0;
        $totalItems = 0;
        
        foreach ($cartItems as $cart) {
            foreach ($cart->orders as $order) {
                $totalAmount += $order->total_price;
                $totalItems += $order->quantity;
            }
        }

        return view('cart', compact('cartItems', 'totalAmount', 'totalItems')); 
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
        
        // Verify this order belongs to the current user's cart
        $cart = Cart::where('user_id', Auth::id())->where('id', $order->cart_id)->first();
        
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Unauthorized action.');
        }

        // Restore weapon quantity
        $order->weaponListing->increment('quantity', $order->quantity);
        $order->weaponListing->update(['is_available' => true]);
        
        // Delete the order
        $order->delete();
        
        // If cart has no more orders, delete the cart
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
                // Restore weapon quantities
                $order->weaponListing->increment('quantity', $order->quantity);
                $order->weaponListing->update(['is_available' => true]);
            }
            // Delete cart and its orders
            $cart->delete();
        }
        
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');  
    }
    public function checkout()
    {
        return redirect()->route('orders.create')->with('success', 'Proceeding to checkout.');
    }
    
}
