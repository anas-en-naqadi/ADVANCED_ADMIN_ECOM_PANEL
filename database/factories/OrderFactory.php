<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'shipping_id' => \App\Models\Shipping::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['canceled', 'processing','returned', 'completed']),
            'amount' => $this->faker->randomFloat()
        ];
    }
}
