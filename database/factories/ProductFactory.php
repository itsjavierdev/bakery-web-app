<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word . rand(20, 8000);
        $slug = $this->faker->word . rand(20, 8000);
        $price_by_bag = $this->faker->randomFloat(2, 1, 100);
        $bag_quantity = $this->faker->numberBetween(1, 99);
        $price = $price_by_bag / $bag_quantity;

        return [
            'name' => $name,
            'slug' => $slug,
            'price' => $price,
            'description' => $this->faker->text,
            'bag_quantity' => $bag_quantity,
            'price_by_bag' => $price_by_bag,
            'discontinued' => $this->faker->boolean,
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
