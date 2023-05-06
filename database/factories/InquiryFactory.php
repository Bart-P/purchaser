<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InquiryFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => fake()->text(50),
            'offers_until' => fake()->dateTimeBetween('now', '+2 weeks', 'Europe/Berlin')->format('Y-m-d'),
            'delivery_date' => fake()->dateTimeBetween('+4 weeks', '+6 months', 'Europe/Berlin')->format('Y-m-d'),
            'status' => fake()->randomElement(['created', 'send', 'waiting', 'done', 'closed']),
            'description' => fake()->text(rand(500, 2000)),
            'project' => fake()->randomNumber(3),
            'pm' => fake()->name(),
            'client' => fake()->company(),
        ];
    }
}