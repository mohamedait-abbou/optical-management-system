<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['Ray-Ban', 'Oakley', 'Polaroid', 'Persol', 'Vogue', 'Arnette', 'Carrera', 'Dior', 'Gucci', 'Prada']),
            'country' => fake()->optional()->country(),
            'description' => fake()->optional()->sentence(),
        ];
    }
}
