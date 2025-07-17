<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeaponTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('weapon_types')->insert([
            [
                'name' => 'Infantry',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tanks',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Artillery Forces',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Air Forces',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Naval Forces',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
