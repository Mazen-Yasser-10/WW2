<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        // Logic to retrieve and return the cart items
        return view('cart'); 
    }
    /**
     * Add an item to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // Logic to add an item to the cart
        return redirect()->route('cart.index')->with('success', 'Item added to cart successfully.');
    }
    /**
     * Remove an item from the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        // Logic to remove an item from the cart
        return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully.');
    }
    /**
     * Clear the cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        // Logic to clear the cart
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');  
    }
    /**
     * Proceed to checkout.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        // Logic to proceed to checkout
        return redirect()->route('orders.create')->with('success', 'Proceeding to checkout.');
    }
    
}
