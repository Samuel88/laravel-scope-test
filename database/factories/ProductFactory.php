<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Gameboy', 'Switch', 'Nintendo']) . fake()->randomNumber(1),
            'description' => fake()->paragraph(4),
            'price' => fake()->randomFloat(2, 0, 100),
        ];
    }
}
