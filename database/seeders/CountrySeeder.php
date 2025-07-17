<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            [
                'name' => 'United States',
                'currency' => 'US Dollar',
                'teamName' => 'Allied Powers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'United Kingdom',
                'currency' => 'Pound Sterling',
                'teamName' => 'Allied Powers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Germany',
                'currency' => 'Reichsmark',
                'teamName' => 'Axis Powers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Soviet Union',
                'currency' => 'Soviet Ruble',
                'teamName' => 'Allied Powers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Japan',
                'currency' => 'Japanese Yen',
                'teamName' => 'Axis Powers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'France',
                'currency' => 'French Franc',
                'teamName' => 'Allied Powers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Italy',
                'currency' => 'Italian Lira',
                'teamName' => 'Axis Powers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Canada',
                'currency' => 'Canadian Dollar',
                'teamName' => 'Allied Powers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Australia',
                'currency' => 'Australian Pound',
                'teamName' => 'Allied Powers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'China',
                'currency' => 'Chinese Yuan',
                'teamName' => 'Allied Powers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Switzerland',
                'currency' => 'Swiss Franc',
                'teamName' => 'Neutral',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sweden',
                'currency' => 'Swedish Krona',
                'teamName' => 'Neutral',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
