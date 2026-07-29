<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'cin' => fake()->regexify('[A-Z]{2}[0-9]{6}'),
            'phone' => '0' . fake()->numerify('6########'),
            'email' => fake()->safeEmail(),
            'address' => fake()->address(),
            'birth_date' => fake()->date(),
            'gender' => fake()->randomElement(['M', 'F']),
            'notes' => fake()->sentence(),
        ];
    }
}
