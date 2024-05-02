<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sale = \App\Models\Sale::factory()->create();
        $staff = \App\Models\Staff::factory()->create();
        $customer = \App\Models\Customer::factory()->create();

        return [
            'sale_id' => $sale->id,
            'amount' => $this->faker->randomFloat(2, 0, 999),
            'staff_id' => $staff->id,
            'customer_id' => $customer->id,
        ];
    }
}
