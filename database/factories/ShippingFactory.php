<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipping>
 */
class ShippingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=> \App\Models\User::inRandomOrder()->first()->id,
            'address'=> $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->streetName,
            'country' => $this->faker->country,
            'postal_code' => $this->faker->postcode
        ];
    }
}
