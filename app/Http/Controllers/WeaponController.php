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

        $converter = app('CurrencyConverter');
        $user = Auth::user();
        $selectedCountry = $user->country->name;
        
        foreach ($weapons as $weapon) {
            $weapon->local_price = $converter->convertWithSymbol($weapon->price, $selectedCountry);
            $weapon->currency_symbol = $converter->getCurrencySymbol($selectedCountry);
        }

        return view('weapons.index', compact('weapons', 'weaponTypes', 'countries', 'selectedCountry'));
    }

    public function show($id)
    {
        $weapon = WeaponListing::with(['weapon', 'country'])
            ->findOrFail($id);
        
        $converter = app('CurrencyConverter');
        $user = Auth::user();
        $selectedCountry = $user->country->name;
        $weapon->local_price = $converter->convertWithSymbol($weapon->price, $selectedCountry);
        $weapon->priceOnly = $converter->convert($weapon->price, $selectedCountry);
        return view('weapons.show', compact('weapon', 'selectedCountry', 'converter'));
    }

    public function create()
    {
        $weaponTypes = WeaponType::all();
        $countries = Country::all();
        
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

        DB::transaction(function () use ($request) {
            $weapon = Weapon::create([
                'name' => $request->name,
                'weapon_type_id' => $request->weapon_type_id,
            ]);

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

    public function edit($id)
    {
        $weapon = WeaponListing::with(['weapon'])->findOrFail($id);
        $weaponTypes = WeaponType::all();
        $countries = Country::all();
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
        
        DB::transaction(function () use ($weaponListing) {
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
