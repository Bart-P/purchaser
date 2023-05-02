<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductPrice>
 */
class ProductPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => fake()->numberBetween(1, 20),
            'amount' => fake()->randomElement([10, 50, 100, 200, 500, 1000]),
            'note' => fake()->text(10, 20),
            'cost_in_cent' => fake()->numberBetween(99, 9999),
            'price_in_cent' => fake()->numberBetween(99, 9999),
        ];
    }
}