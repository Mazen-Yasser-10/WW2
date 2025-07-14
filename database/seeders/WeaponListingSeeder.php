<?php

namespace Database\Seeders;

use App\Models\WeaponListing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeaponListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WeaponListing::factory(50)->create();
    }
}
