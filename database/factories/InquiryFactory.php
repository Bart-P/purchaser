<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inquiry>
 */
class InquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->text(50),
            'status' => fake()->randomElement(['created', 'send', 'waiting', 'done', 'closed']),
            'description' => fake()->text(rand(500, 2000)),
            'project' => fake()->randomNumber(3),
            'pm' => fake()->name(),
            'client' => fake()->company(),
        ];
    }
}