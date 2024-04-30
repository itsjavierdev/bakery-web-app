<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $total = $this->faker->randomFloat(2, 0, 99999);
        $paid_amount = $this->faker->randomFloat(2, 0, $total);

        return [
            'total' => $total,
            'paid_amount' => $paid_amount,
            'paid' => $paid_amount == $total,
            'total_quantity' => $this->faker->numberBetween(1, 100),
            'customer_id' => \App\Models\Customer::factory(),
            'staff_id' => \App\Models\Staff::factory(),
        ];
    }
}
