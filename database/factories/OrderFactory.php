<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $address = \App\Models\Address::factory()->create();

        $startDate = Carbon::now();
        $endDate = Carbon::now()->addMonth();

        $total = $this->faker->randomFloat(2, 0, 99999);
        $paid_amount = $this->faker->randomFloat(2, 0, $total);

        return [
            'total' => $total,
            'paid_amount' => $paid_amount,
            'paid' => $paid_amount == $total,
            'address_id' => $address,
            'total_quantity' => $this->faker->numberBetween(1, 100),
            'delivery_date' => $this->faker->dateTimeBetween($startDate, $endDate),
            'delivery_time_id' => \App\Models\DeliveryTime::factory(),
            'customer_id' => $address->customer_id, // Usa el customer_id del address generado
        ];
    }
}
