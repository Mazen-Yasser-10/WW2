<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\WeaponListing;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['cart.user', 'weaponListing.weapon.weaponType', 'weaponListing.weapon.country'])
            ->latest()
            ->get();
        return view('orders.index', compact('orders'));
    }
    public function create()
    {
        $carts = Cart::all();
        $weapons = WeaponListing::all();
        return view('orders.create',compact('carts','weapons'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'weapon_listing_id' =>  'required|exists:weapon_listing,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $weapon = WeaponListing::findOrFail($request->get('weapon_listing_id'));
        $total_price = $weapon->price * $request->get('quantity');

        Order::create([
            'cart_id' => $request->get('cart_id'),
            'weapon_listing_id' => $request ->get('weapon_listing_id'),
            'quantity' => $request->get('quantity'),
            'total_price' => $total_price
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }
}
