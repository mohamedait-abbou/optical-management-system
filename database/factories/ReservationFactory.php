<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'reservation_date' => fake()->date(),
            'reservation_time' => fake()->randomElement(['09:00', '10:00', '11:00', '14:00', '15:00', '16:00']),
            'reason' => fake()->randomElement(['Examen de la vue', 'Ajustement monture', 'Consultation lentilles', 'Choix de monture', 'Retrait commande']),
            'status' => fake()->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
            'notes' => fake()->sentence(),
        ];
    }
}
