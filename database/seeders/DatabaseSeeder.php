<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Country;
use App\Models\WeaponListing;
use Database\Factories\WeaponFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First, seed the countries and weapon types
        $this->call([
            CountrySeeder::class,
            WeaponTypeSeeder::class,
            WeaponListingSeeder::class,
        ]);

        // Get all country IDs to assign to users
        $countryIds = Country::pluck('id')->toArray();

        // Create a test user with a specific country (UK)
        $ukCountry = Country::where('name', 'United Kingdom')->first();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'country_id' => $ukCountry->id,
        ]);

        // Create 10 additional users with random countries
        User::factory(10)->create([
            'country_id' => fn() => fake()->randomElement($countryIds),
        ]);
    }
}
