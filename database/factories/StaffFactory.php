<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $birthdate = $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d');

        $phone = $this->faker->numberBetween(60000000, 80090000);

        $ciNumber = $this->faker->numberBetween(100000, 99000000);
        $ciRegion = $this->faker->randomElement(['SC', 'LP', 'CB', 'OR', 'PT', 'TJ', 'CH', 'PA', 'BE']);
        $CI = $ciNumber . ' ' . $ciRegion;

        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'phone' => $phone,
            'CI' => $CI,
            'birthdate' => $birthdate,
        ];
    }
}
