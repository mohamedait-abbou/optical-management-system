<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true),
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'price' => fake()->randomFloat(2, 50, 2000),
            'cost_price' => fake()->randomFloat(2, 20, 1000),
            'quantity' => fake()->numberBetween(0, 100),
            'alert_threshold' => fake()->numberBetween(2, 10),
            'description' => fake()->optional()->sentence(),
        ];
    }
}
