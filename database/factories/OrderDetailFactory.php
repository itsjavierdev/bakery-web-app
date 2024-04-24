<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = \App\Models\Product::factory()->create();
        $price = $product->price;
        $quantity = $this->faker->numberBetween(1, 10);
        $subtotal = $price * $quantity;

        return [
            'order_id' => \App\Models\Order::factory(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'product_price' => $price,
            'subtotal' => $subtotal,
            'by_bag' => $this->faker->boolean(),
        ];
    }
}
