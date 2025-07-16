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
                'name' => 'Switzerland',
                'currency' => 'Swiss Franc',
                'teamName' => 'Axis Powers',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
        ]);
    }
}
