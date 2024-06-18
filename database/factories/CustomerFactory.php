<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $phone = $this->faker->numberBetween(60000000, 80090000);

        return [
            "name" => $this->faker->firstName(),
            "surname" => $this->faker->lastName(),
            'phone' => $phone,
            'email' => $this->faker->unique()->safeEmail(),
            'verified' => true,
        ];

    }

    public function configure()
    {
        return $this->afterCreating(function (Customer $customer) {
            Address::factory()->create([
                'customer_id' => $customer->id,
            ]);
        });
    }
}
