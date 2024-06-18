<?php

namespace Database\Factories;

use Carbon\Carbon;
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
        $customer = \App\Models\Customer::inRandomOrder()->first();
        $staff = \App\Models\Staff::inRandomOrder()->first();
        $sale = \App\Models\Sale::inRandomOrder()->first();
        $date = $this->faker->dateTimeBetween('-30 days', 'now');

        return [
            'sale_id' => $sale->id,
            'amount' => $this->faker->randomFloat(2, 0, 999),
            'staff_id' => $staff->id,
            'customer_id' => $customer->id,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }

}
