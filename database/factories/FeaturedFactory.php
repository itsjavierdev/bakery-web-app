<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Featured>
 */
class FeaturedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => "pruebas",
            'position' => $this->faker->randomNumber(2),
            'image' => 'products/XlXTTyF5P5vDvW8XmhMiCK8i5rGu806eDwjLQ23a.jpg',
            'is_active' => $this->faker->boolean,
            'has_filter' => $this->faker->boolean,
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
