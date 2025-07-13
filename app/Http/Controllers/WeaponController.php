<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Weapon;
use App\Models\WeaponListing;
use App\Models\WeaponType;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Country;

class WeaponController extends Controller
{
    public function index(Request $request)
    {
        $query = WeaponListing::with(['weapon', 'country']);

        // Apply filters
        if ($request->filled('weapon_type')) {
            $query->whereHas('weapon', function ($q) use ($request) {
                $q->where('weapon_type_id', $request->weapon_type);
            });
        }

        if ($request->filled('country')) {
            $query->where('country_id', $request->country);
        }

        if ($request->filled('market_type')) {
            $query->where('marketType', $request->market_type);
        }

        $weapons = $query->paginate(12);
        $weaponTypes = WeaponType::all();
        $countries = Country::all();

        return view('weapons.index', compact('weapons', 'weaponTypes', 'countries'));
    }

    public function show($id)
    {
        // Display specific weapon with all listings
        $weapon = Weapon::with(['weaponType', 'weaponListings.country'])
            ->findOrFail($id);
        
        return view('weapons.show', compact('weapon'));
    }

    public function create()
    {
        $weaponTypes = WeaponType::all();
        $countries = Country::all();
        
        // Create default weapon types if none exist
        if ($weaponTypes->isEmpty()) {
            $defaultTypes = [
                ['name' => 'Infantry'],
                ['name' => 'Tanks'],
                ['name' => 'Artillery Forces'],
                ['name' => 'Air Forces'],
                ['name' => 'Naval Forces'],
            ];
            
            foreach ($defaultTypes as $type) {
                WeaponType::create($type);
            }
            
            $weaponTypes = WeaponType::all();
        }
        
        return view('weapons.create', compact('weaponTypes', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weapon_type_id' => 'required|exists:weapon_types,id',
            'country_id' => 'required|exists:countries,id',
            'market_type' => 'required|in:national,international',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        // Use transaction for creating weapon and listing
        DB::transaction(function () use ($request) {
            // Create weapon (base specifications)
            $weapon = Weapon::create([
                'name' => $request->name,
                'weapon_type_id' => $request->weapon_type_id,
            ]);

            // Create weapon listing (country-specific variant)
            WeaponListing::create([
                'weapon_id' => $weapon->id,
                'country_id' => $request->country_id,
                'marketType' => $request->market_type,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'is_available' => true,
            ]);
        });

        return redirect()->route('weapons.index')->with('success', 'Weapon created successfully.');
    }

    /**
     * Add weapon to cart - requires transaction
     */
    public function addToCart(Request $request, $weaponListingId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $weaponListing = WeaponListing::findOrFail($weaponListingId);
        
        if ($weaponListing->quantity < $request->quantity) {
            return back()->withErrors(['quantity' => 'Not enough quantity available.']);
        }

        // Use transaction for cart operations
        DB::transaction(function () use ($request, $weaponListing) {
            // Get or create user's cart
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id(),
                'status' => 'open'
            ]);

            // Create order
            Order::create([
                'cart_id' => $cart->id,
                'weapon_listing_id' => $weaponListing->id,
                'quantity' => $request->quantity,
                'total_price' => $weaponListing->price * $request->quantity,
            ]);

            // Update weapon listing quantity
            $weaponListing->decrement('quantity', $request->quantity);
            
            // Mark as unavailable if quantity reaches 0
            if ($weaponListing->quantity <= 0) {
                $weaponListing->update(['is_available' => false]);
            }
        });

        return redirect()->route('cart.index')->with('success', 'Weapon added to cart.');
    }

    /**
     * Process cart checkout - requires transaction
     */
    public function checkout(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'open')
            ->with('orders.weaponListing')
            ->firstOrFail();

        // Use transaction for checkout process
        DB::transaction(function () use ($cart) {
            // Verify all items are still available
            foreach ($cart->orders as $order) {
                if (!$order->weaponListing->is_available || 
                    $order->weaponListing->quantity < $order->quantity) {
                    throw new \Exception("Item {$order->weaponListing->weapon->name} is no longer available");
                }
            }

            // Mark cart as submitted
            $cart->update(['status' => 'submitted']);
            
            // Here you would integrate with payment processing
            // Update inventory, send notifications, etc.
        });

        return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
    }

    public function edit($id)
    {
        $weapon = WeaponListing::with(['weapon'])->findOrFail($id);
        $weaponTypes = WeaponType::all();
        $countries = Country::all();
        // Ensure the weapon has a valid type and country
        return view('weapons.edit', compact('weapon', 'weaponTypes', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'is_available' => 'boolean',
        ]);

        $weaponListing = WeaponListing::findOrFail($id);
        
        // Use transaction for updates that affect availability
        DB::transaction(function () use ($request, $weaponListing) {
            $weaponListing->update([
                'price' => $request->price,
                'quantity' => $request->quantity,
                'is_available' => $request->quantity > 0 ? $request->boolean('is_available', true) : false,
            ]);
        });

        return redirect()->route('weapons.index')->with('success', 'Weapon updated successfully.');
    }

    public function destroy($id)
    {
        $weaponListing = WeaponListing::findOrFail($id);
        
        // Use transaction for deletion
        DB::transaction(function () use ($weaponListing) {
            // Check if weapon has active orders
            $hasActiveOrders = Order::whereHas('cart', function ($query) {
                $query->where('status', 'open');
            })->where('weapon_listing_id', $weaponListing->id)->exists();

            if ($hasActiveOrders) {
                throw new \Exception('Cannot delete weapon with active orders');
            }

            $weaponListing->delete();
        });

        return redirect()->route('weapons.index')->with('success', 'Weapon deleted successfully.');
    }
}
