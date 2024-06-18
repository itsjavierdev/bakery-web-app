<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Staff;
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

    public function definition()
    {
        $customer = Customer::inRandomOrder()->first();
        $staff = Staff::inRandomOrder()->first();
        $date = $this->faker->dateTimeBetween('-30 days', 'now');


        return [
            // Define solo los atributos básicos necesarios para la creación inicial
            'total' => $this->faker->randomFloat(2, 0, 99999),
            'paid_amount' => $this->faker->randomFloat(2, 0, 99999),
            'paid' => $this->faker->boolean(),
            'total_quantity' => $this->faker->numberBetween(1, 10),
            'customer_id' => $customer->id,
            'staff_id' => $staff->id,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }

    public function configure()
    {

        return $this->afterCreating(function (Sale $sale) {
            // Operaciones adicionales después de crear la venta
            $numSaleDetails = $this->faker->numberBetween(2, 3);

            $customer_id = $sale->customer->id;
            $staff_id = $sale->staff->id;
            $date = $sale->created_at;
            // Create SaleDetail instances
            SaleDetail::factory($numSaleDetails)->create([
                'sale_id' => $sale->id,
                'created_at' => $date,
                'updated_at' => $date,
            ]);


            // Calculate total and paid_amount based on SaleDetail subtotals
            $total = SaleDetail::where('sale_id', $sale->id)->sum('subtotal');
            $paid_amount = $this->faker->randomFloat(0, 0, $total);


            // Create Payment instance
            Payment::factory()->create([
                'sale_id' => $sale->id,
                'amount' => $paid_amount,
                'staff_id' => $staff_id,
                'customer_id' => $customer_id,
                'created_at' => $date,
            ]);

            // Update Sale with calculated totals
            $sale->update([
                'total_quantity' => SaleDetail::where('sale_id', $sale->id)->sum('quantity'),
                'total' => $total,
                'paid_amount' => $paid_amount,
                'paid' => $paid_amount == $total,
            ]);
        });
    }
}
