<?php

namespace Database\Seeders;

use App\Models\Weapon;
use App\Models\WeaponListing;
use App\Models\Country;
use Illuminate\Database\Seeder;

class WeaponListingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weapons = Weapon::all();
        $countries = Country::all();

        foreach ($weapons as $weapon) {
            // Create 1-3 listings per weapon from different countries
            $numListings = rand(1, 3);
            $selectedCountries = $countries->random($numListings);

            foreach ($selectedCountries as $country) {
                $basePrice = $this->getBasePriceByWeaponType($weapon->weaponType->name);
                $priceVariation = rand(80, 120) / 100; // 20% price variation
                $finalPrice = $basePrice * $priceVariation;

                WeaponListing::create([
                    'weapon_id' => $weapon->id,
                    'country_id' => $country->id,
                    'marketType' => rand(1, 10) <= 7 ? 'international' : 'national', // 70% international
                    'price' => round($finalPrice, 2),
                    'quantity' => rand(10, 100),
                    'is_available' => rand(1, 10) <= 9, // 90% available
                ]);
            }
        }
    }

    /**
     * Get base price based on weapon type
     */
    private function getBasePriceByWeaponType(string $weaponType): float
    {
        return match($weaponType) {
            'Infantry' => rand(500, 2000),
            'Tanks' => rand(50000, 200000),
            'Artillery Forces' => rand(20000, 80000),
            'Air Forces' => rand(100000, 500000),
            'Naval Forces' => rand(500000, 2000000),
            default => rand(1000, 10000),
        };
    }
}
