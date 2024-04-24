<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alias' => $this->faker->unique()->word(),
            'address' => $this->faker->address(),
            'reference' => $this->faker->text(80),
            'customer_id' => \App\Models\Customer::factory(),
        ];
    }
}
