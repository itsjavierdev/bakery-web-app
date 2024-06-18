<?php

namespace Database\Factories;

use App\Models\Product;
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
        // Get a random Product from the database
        $product = Product::inRandomOrder()->first();

        // Define the SaleDetail attributes
        $quantity = $this->faker->numberBetween(1, 10);
        $by_bag = true;
        $subtotal = $by_bag ? $product->price_by_bag * $quantity : $product->price * $quantity;

        return [
            'product_id' => $product->id,
            'quantity' => $quantity,
            'product_price' => $product->price,
            'subtotal' => $subtotal,
            'by_bag' => $by_bag,
            'created_at' => $this->faker->dateTimeBetween('now', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('now', 'now'),
        ];
    }
}
