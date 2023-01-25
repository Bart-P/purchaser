<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
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
                    'invoice',
                    'delivery',
                ]),
            'name1'       => fake()->unique()->company(),
            'name2'       => fake()->name(),
            'name3'       => fake()->randomElement(
                [
                    '',
                    'Hintereingang',
                    '',
                    'im Hof',
                    '',
                    'Bitte im Flur abstellen',
                ]),
            'street'      => fake()->streetAddress(),
            'street_nr'   => fake()->numberBetween(1, 100),
            'city_code'   => fake()->postcode(),
            'city'        => fake()->city(),
            'country'     => fake()->country(),
            'phone'       => fake()->randomElement(
                [
                    fake()->phoneNumber(),
                    null,
                ]),
        ];
    }
}