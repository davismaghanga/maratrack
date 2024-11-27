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
            'name' => fake()->word, // Random product name
            'opening_stock'=> fake()->randomFloat(1,10,100),
            'current_stock'=> fake()->randomFloat(1,10,100),
            'closing_stock'=> fake()->randomFloat(1,10,100),
            'packaged_products'=> fake()->numberBetween(10,100),
        ];
    }
}
