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
                'image' => 'https://flagcdn.com/w320/us.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'United Kingdom',
                'currency' => 'Pound Sterling',
                'teamName' => 'Allied Powers',
                'image' => 'https://flagcdn.com/w320/gb.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Germany',
                'currency' => 'Reichsmark',
                'teamName' => 'Axis Powers',
                'image' => 'https://flagcdn.com/w320/de.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Soviet Union',
                'currency' => 'Soviet Ruble',
                'teamName' => 'Allied Powers',
                'image' => 'https://flagcdn.com/w320/ru.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Japan',
                'currency' => 'Japanese Yen',
                'teamName' => 'Axis Powers',
                'image' => 'https://flagcdn.com/w320/jp.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'France',
                'currency' => 'French Franc',
                'teamName' => 'Allied Powers',
                'image' => 'https://flagcdn.com/w320/fr.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Italy',
                'currency' => 'Italian Lira',
                'teamName' => 'Axis Powers',
                'image' => 'https://flagcdn.com/w320/it.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Canada',
                'currency' => 'Canadian Dollar',
                'teamName' => 'Allied Powers',
                'image' => 'https://flagcdn.com/w320/ca.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Australia',
                'currency' => 'Australian Pound',
                'teamName' => 'Allied Powers',
                'image' => 'https://flagcdn.com/w320/au.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'China',
                'currency' => 'Chinese Yuan',
                'teamName' => 'Allied Powers',
                'image' => 'https://flagcdn.com/w320/cn.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Switzerland',
                'currency' => 'Swiss Franc',
                'teamName' => 'Neutral',
                'image' => 'https://flagcdn.com/w320/ch.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sweden',
                'currency' => 'Swedish Krona',
                'teamName' => 'Neutral',
                'image' => 'https://flagcdn.com/w320/se.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
