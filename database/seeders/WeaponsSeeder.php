<?php

namespace Database\Seeders;

use App\Models\Weapon;
use App\Models\WeaponType;
use Illuminate\Database\Seeder;

class WeaponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weaponTypes = WeaponType::all();

        // Get weapon type IDs with error handling
        $infantryType = $weaponTypes->where('name', 'Infantry')->first();
        $tanksType = $weaponTypes->where('name', 'Tanks')->first();
        $artilleryType = $weaponTypes->where('name', 'Artillery Forces')->first();
        $airType = $weaponTypes->where('name', 'Air Forces')->first();
        $navalType = $weaponTypes->where('name', 'Naval Forces')->first();

        if (!$infantryType || !$tanksType || !$artilleryType || !$airType || !$navalType) {
            throw new \Exception('Required weapon types not found. Make sure WeaponTypeSeeder has run first.');
        }

        $weapons = [
            // Infantry Weapons
            [
                'name' => 'M1 Garand',
                'weapon_type_id' => $infantryType->id,
            ],
            [
                'name' => 'Thompson M1928',
                'weapon_type_id' => $infantryType->id,
            ],
            [
                'name' => 'StG 44',
                'weapon_type_id' => $infantryType->id,
            ],
            [
                'name' => 'Lee-Enfield',
                'weapon_type_id' => $infantryType->id,
            ],
            [
                'name' => 'Mosin-Nagant',
                'weapon_type_id' => $infantryType->id,
            ],

            // Tanks
            [
                'name' => 'M4 Sherman',
                'weapon_type_id' => $tanksType->id,
            ],
            [
                'name' => 'Tiger I',
                'weapon_type_id' => $tanksType->id,
            ],
            [
                'name' => 'T-34',
                'weapon_type_id' => $tanksType->id,
            ],
            [
                'name' => 'Churchill VII',
                'weapon_type_id' => $tanksType->id,
            ],

            // Artillery
            [
                'name' => '88mm FlaK 36',
                'weapon_type_id' => $artilleryType->id,
            ],
            [
                'name' => 'Katyusha',
                'weapon_type_id' => $artilleryType->id,
            ],
            [
                'name' => 'M1 155mm Howitzer',
                'weapon_type_id' => $artilleryType->id,
            ],

            // Air Forces
            [
                'name' => 'P-51 Mustang',
                'weapon_type_id' => $airType->id,
            ],
            [
                'name' => 'Messerschmitt Bf 109',
                'weapon_type_id' => $airType->id,
            ],
            [
                'name' => 'Supermarine Spitfire',
                'weapon_type_id' => $airType->id,
            ],
            [
                'name' => 'Yakovlev Yak-3',
                'weapon_type_id' => $airType->id,
            ],

            // Naval Forces
            [
                'name' => 'USS Iowa Battleship',
                'weapon_type_id' => $navalType->id,
            ],
            [
                'name' => 'U-boat Type VII',
                'weapon_type_id' => $navalType->id,
            ],
            [
                'name' => 'HMS Hood',
                'weapon_type_id' => $navalType->id,
            ],
        ];

        foreach ($weapons as $weapon) {
            Weapon::create($weapon);
        }
    }
}
