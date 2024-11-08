<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'surname' => fake()->lastName,
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->e164PhoneNumber,
            'country' => fake()->country,
        ];
    }
}
