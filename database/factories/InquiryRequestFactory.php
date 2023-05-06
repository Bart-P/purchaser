<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InquiryRequest>
 */
class InquiryRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_id' => fake()->randomNumber(1, 100),
            'message' => fake()->text(50),
            'status' => fake()->randomElement(['created', 'send', 'waiting', 'done', 'closed']),
        ];
    }
}