<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleDetail>
 */
class SaleDetailFactory extends Factory
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
            'sale_id' => \App\Models\Sale::factory(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'product_price' => $price,
            'subtotal' => $subtotal,
            'by_bag' => $this->faker->boolean(),
        ];
    }
}
