<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = Country::all();

        // Create admin users for major countries
        $adminCountries = [
            'United States',
            'United Kingdom',
            'Germany',
            'Soviet Union',
            'Japan',
        ];

        foreach ($adminCountries as $countryName) {
            $country = $countries->where('name', $countryName)->first();
            if ($country) {
                User::create([
                    'name' => $countryName . ' Admin',
                    'email' => strtolower(str_replace(' ', '', $countryName)) . '@admin.ww2',
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'country_id' => $country->id,
                    'role' => 'admin',
                    'remember_token' => null,
                ]);
            }
        }

        // Create government users
        foreach ($countries->take(10) as $country) {
            User::create([
                'name' => $country->name . ' Government',
                'email' => strtolower(str_replace(' ', '', $country->name)) . '@gov.ww2',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'country_id' => $country->id,
                'role' => 'government',
                'remember_token' => null,
            ]);
        }

        // Create test users
        $usCountry = $countries->where('name', 'United States')->first();
        $ukCountry = $countries->where('name', 'United Kingdom')->first();
        $germanyCountry = $countries->where('name', 'Germany')->first();

        if ($usCountry) {
            User::create([
                'name' => 'Test Admin',
                'email' => 'admin@test.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'country_id' => $usCountry->id,
                'role' => 'admin',
                'remember_token' => null,
            ]);
        }

        if ($ukCountry) {
            User::create([
                'name' => 'Test Government',
                'email' => 'government@test.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'country_id' => $ukCountry->id,
                'role' => 'government',
                'remember_token' => null,
            ]);
        }

        if ($germanyCountry) {
            User::create([
                'name' => 'Test General',
                'email' => 'general@test.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'country_id' => $germanyCountry->id,
                'role' => 'general',
                'remember_token' => null,
            ]);
        }

        // Create random general users using factory
        User::factory(20)->create([
            'role' => 'general',
            'country_id' => fn() => $countries->random()->id,
        ]);
    }
}
