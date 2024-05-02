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

        return [
            'name' => $name,
            'slug' => $slug,
            'price' => $this->faker->randomFloat(2, 0, 100),
            'description' => $this->faker->text,
            'bag_quantity' => $this->faker->randomNumber(2),
            'discontinued' => $this->faker->boolean,
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
