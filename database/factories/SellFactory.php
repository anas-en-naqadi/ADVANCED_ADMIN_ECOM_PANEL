<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sell>
 */
class SellFactory extends Factory
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
            'product_id' => \App\Models\Product::inRandomOrder()->first()->id,
            'invoice_id' => $this->faker->boolean(50) ? \App\Models\Invoice::inRandomOrder()->first()->id : null,
            'quantity' => $this->faker->numberBetween(1,100),
            'total_amount' => $this->faker->numberBetween(60,10000)
        ];
    }
}
