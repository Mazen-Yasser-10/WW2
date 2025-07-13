<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Country;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed in order of dependencies
        $this->call([
            CountrySeeder::class,
            WeaponTypeSeeder::class,
            UsersSeeder::class,
            WeaponsSeeder::class,
            WeaponListingsSeeder::class,
            CartsSeeder::class,
            OrdersSeeder::class,
        ]);
    }
}
