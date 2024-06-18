<?php

namespace Database\Factories;

use App\Livewire\Admin\Transactions\Orders\Deliver;
use App\Models\Address;
use App\Models\Customer;
use App\Models\DeliveryTime;
use App\Models\Order;
use App\Models\OrderDetail;
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
        $picked_up = $this->faker->boolean();

        $customer = Customer::inRandomOrder()->first();
        $delivery_date = $this->faker->dateTimeBetween('+1 day', '+1 week');
        $pickupTime = DeliveryTime::inRandomOrder()->first();
        $deliveryTime = DeliveryTime::where('for_delivery', 1)->inRandomOrder()->first();

        return [
            'total' => $this->faker->randomFloat(2, 0, 99999),
            'paid_amount' => null,
            'paid' => false,
            'address_id' => $picked_up ? null : Address::where('customer_id', $customer->id)->inRandomOrder()->first()->id,
            'picked_up' => $picked_up,
            'total_quantity' => $this->faker->numberBetween(1, 10),
            'delivery_date' => $delivery_date,
            'delivery_time_id' => $picked_up ? $pickupTime->id : $deliveryTime->id,
            'customer_id' => $customer->id, // Usa el customer_id del address generado
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            $numOrderDetails = $this->faker->numberBetween(2, 3);

            $customer_id = $order->customer_id;
            $delivery_date = $order->delivery_date;

            OrderDetail::factory($numOrderDetails)->create([
                'order_id' => $order->id,
            ]);

            $total = OrderDetail::where('order_id', $order->id)->sum('subtotal');

            $order->update([
                'total_quantity' => OrderDetail::where('order_id', $order->id)->sum('quantity'),
                'total' => $total,
            ]);

        });
    }
}
