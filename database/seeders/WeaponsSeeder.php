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
            // Infantry Weapons - Using CS:GO weapon images
            [
                'name' => 'AK-47 Kalashnikov',
                'weapon_type_id' => $infantryType->id,
                'description' => 'Soviet assault rifle, reliable and powerful',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/AK-47.webp',
            ],
            [
                'name' => 'M4A4 Carbine', 
                'weapon_type_id' => $infantryType->id,
                'description' => 'American assault rifle, accurate and versatile',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/M4A4.webp',
            ],
            [
                'name' => 'AWP Sniper Rifle',
                'weapon_type_id' => $infantryType->id,
                'description' => 'High-precision sniper rifle, one shot one kill',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/AWP.webp',
            ],
            [
                'name' => 'Galil Assault Rifle',
                'weapon_type_id' => $infantryType->id,
                'description' => 'Israeli assault rifle, robust and reliable',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/Galil%20AR.webp',
            ],
            [
                'name' => 'FAMAS Bullpup',
                'weapon_type_id' => $infantryType->id,
                'description' => 'French bullpup assault rifle, unique design',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/FAMAS.webp',
            ],
            [
                'name' => 'MP5 Submachine Gun',
                'weapon_type_id' => $infantryType->id,
                'description' => 'German submachine gun, compact and effective',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/MP5-SD.webp',
            ],

            // Tanks - Using CS:GO weapon images for heavy weapons
            [
                'name' => 'M249 Heavy Machine Gun',
                'weapon_type_id' => $tanksType->id,
                'description' => 'American light machine gun, sustained fire support',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/M249.webp',
            ],
            [
                'name' => 'Negev Machine Gun',
                'weapon_type_id' => $tanksType->id,
                'description' => 'Israeli machine gun, devastating firepower',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/Negev.webp',
            ],
            [
                'name' => 'Nova Shotgun',
                'weapon_type_id' => $tanksType->id,
                'description' => 'Pump-action shotgun, close quarters combat',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/Nova.webp',
            ],
            [
                'name' => 'XM1014 Auto Shotgun',
                'weapon_type_id' => $tanksType->id,
                'description' => 'Semi-automatic shotgun, rapid firepower',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/XM1014.webp',
            ],

            // Artillery - Using CS:GO heavy weapons
            [
                'name' => 'MAG-7 Tactical Shotgun',
                'weapon_type_id' => $artilleryType->id,
                'description' => 'Magazine-fed shotgun, tactical operations',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/MAG-7.webp',
            ],
            [
                'name' => 'Sawed-Off Shotgun',
                'weapon_type_id' => $artilleryType->id,
                'description' => 'Short-barrel shotgun, devastating at close range',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/Sawed-Off.webp',
            ],
            [
                'name' => 'G3SG1 Sniper Rifle',
                'weapon_type_id' => $artilleryType->id,
                'description' => 'German sniper rifle, precision long-range weapon',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/G3SG1.webp',
            ],

            // Air Forces - Using CS:GO SMGs and rifles
            [
                'name' => 'P90 Personal Defense Weapon',
                'weapon_type_id' => $airType->id,
                'description' => 'Belgian PDW, high rate of fire, air crew protection',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/P90.webp',
            ],
            [
                'name' => 'MP7 Personal Defense Weapon',
                'weapon_type_id' => $airType->id,
                'description' => 'German PDW, compact and lightweight for aircrew',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/MP7.webp',
            ],
            [
                'name' => 'UMP-45 Submachine Gun',
                'weapon_type_id' => $airType->id,
                'description' => 'German SMG, reliable sidearm for pilots',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/UMP-45.webp',
            ],
            [
                'name' => 'MAC-10 Machine Pistol',
                'weapon_type_id' => $airType->id,
                'description' => 'American machine pistol, compact emergency weapon',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/MAC-10.webp',
            ],

            // Naval Forces - Using CS:GO pistols and SMGs
            [
                'name' => 'Desert Eagle Pistol',
                'weapon_type_id' => $navalType->id,
                'description' => 'Powerful handgun, naval officer sidearm',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/Desert%20Eagle.webp',
            ],
            [
                'name' => 'Five-SeveN Pistol',
                'weapon_type_id' => $navalType->id,
                'description' => 'Belgian pistol, reliable naval service weapon',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/Five-SeveN.webp',
            ],
            [
                'name' => 'Glock-18 Pistol',
                'weapon_type_id' => $navalType->id,
                'description' => 'Austrian pistol, standard naval sidearm',
                'image' => 'https://www.csgodatabase.com/images/weapons/webp/Glock-18.webp',
            ],
        ];

        foreach ($weapons as $weapon) {
            Weapon::create($weapon);
        }
    }
}
