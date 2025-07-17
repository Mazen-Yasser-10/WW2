<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Weapon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeaponListing>
 */
class WeaponListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'weapon_id' => Weapon::factory(),
            'price' => fake()->numberBetween(100, 10000),
            'quantity' => fake()->numberBetween(1, 100),
            'marketType' => fake()->randomElement(['national', 'international']),
            'is_available' => true,
            'created_at' => now(),
            'updated_at' => now(),
            
        ];
    }
}
