<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\WeaponListing;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        // Logic to retrieve and return a list of orders
        return view('orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carts = Cart::all();
        $weapons = WeaponListing::all();
        return view('orders.create',compact('carts','weapons'));
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
