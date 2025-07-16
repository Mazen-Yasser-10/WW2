<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeaponType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Weapon>
 */
class WeaponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>fake()->name(),
            'weapon_type_id' => WeaponType::inRandomOrder()->first()->id,
            'description' => fake()->paragraph(),
            'country_id' => fake()->numberBetween(1, 4),
            'image' => fake()->imageUrl(),
            'is_available' => true
        ];
    }
}
