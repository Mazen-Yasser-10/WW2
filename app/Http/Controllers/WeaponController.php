<?php

namespace App\Http\Controllers;

use App\Models\Weapon;
use App\Models\WeaponListing;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeaponController extends Controller
{
    /**
     * Display a listing of the weapons.
     *
     * @return \Illuminate\Http\Response
     */
    public function internatinalMarket()
    {
        // Logic to retrieve and return a list of weapons
        
        return view('weapons.internationalMarket', [
            'weapons' => WeaponListing::whereHas('weapon', function ($query) {
                $query->where('country_id', '!=', Auth::user()->country_id);
            })->with('weapon')->paginate(9),
        ]);
    }

    public function nationalMarket()
    {
        // Logic to retrieve and return a list of weapons
        
        return view('weapons.internationalMarket', [
            'weapons' => WeaponListing::whereHas('weapon', function ($query) {
                $query->where('country_id', '=', Auth::user()->country_id);
            })->with('weapon')->paginate(9),
        ]);
    }

    /**
     * Show the form for creating a new weapon.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Logic to show the form for creating a new weapon
        return view('weapons.create');
    }

    /**
     * Store a newly created weapon in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Logic to store a new weapon
        
        return redirect()->route('weapons.market')->with('success', 'Weapon created successfully.');
    }

    /**
     * Display the specified weapon.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(WeaponListing $id)
    {
        // Logic to display a specific weapon by ID
        
        return view('weapons.show', ['weapon' => $id]);
    }

    /**
     * Show the form for editing the specified weapon.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Logic to show the form for editing a specific weapon
        return view('weapons.edit', ['weapon']);
    }

    /**
     * Update the specified weapon in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Logic to update a specific weapon
        return redirect()->route('weapons.show', $id)->with('success', 'Weapon updated successfully.');
    }

    /**
     * Remove the specified weapon from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Logic to delete a specific weapon
        return redirect()->route('weapons.market')->with('success', 'Weapon deleted successfully.');
    }
}
