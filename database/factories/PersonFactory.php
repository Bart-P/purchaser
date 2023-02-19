<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'supplier_id' => fake()->numberBetween(1, 100),
            'type'        => fake()->randomElement(
                [
                    'main',
                    'secondary',
                    'other',
                ]
            ),
            'gender'      => fake()->randomElement(['m', 'f', 'o']),
            'first_name'  => fake()->firstName(),
            'last_name'   => fake()->lastName(),
            'position'    => fake()->randomElement(
                [
                    'GF',
                    'marketing',
                    null,
                    null,
                ]),
            'phone1'      => fake()->phoneNumber(),
            'phone2'      => fake()->randomElement(
                [
                    null,
                    null,
                    null,
                    null,
                    fake()->phoneNumber(),
                ]),
            'email1'      => fake()->email(),
            'email2'      => fake()->randomElement(
                [
                    null,
                    null,
                    null,
                    null,
                    fake()->email(),
                ]),

        ];
    }
}