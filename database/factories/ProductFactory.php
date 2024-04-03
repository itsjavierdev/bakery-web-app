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
        return [
            'name' => $this->faker->unique->word,
            'slug' => $this->faker->unique->word,
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'description' => $this->faker->text,
            'bag_quantity' => $this->faker->randomNumber(2),
            'discontinued' => $this->faker->boolean,
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
