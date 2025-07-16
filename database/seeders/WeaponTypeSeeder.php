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
                'name' => 'infantry',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'tanks',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'artillery forces',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'navel forces',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'plans',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
        ]);
    }
}
