<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word() . ' ' . fake()->randomElement(['Lunettes', 'Solaire', 'Lentilles', 'Accessoires', 'Montures']),
            'description' => fake()->optional()->sentence(),
        ];
    }
}
