<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderFactory extends Factory
{
    protected $model = PurchaseOrder::class;

    public function definition(): array
    {
        return [
            'supplier_id' => Supplier::factory(),
            'order_number' => 'PO-' . now()->format('Ymd') . '-' . fake()->unique()->randomNumber(4),
            'order_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'expected_date' => fake()->optional(0.7)->dateTimeBetween('now', '+2 months'),
            'status' => fake()->randomElement(['pending', 'received']),
            'total_amount' => 0,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
