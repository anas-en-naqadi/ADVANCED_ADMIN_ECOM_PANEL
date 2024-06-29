<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => \App\Models\Order::inRandomOrder()->first()->id,
            'paypal_transaction_id' => $this->faker->randomElement([null,$this->faker->randomNumber()]),
            'payment_method' => $this->faker->randomElement(['paypal','cod']),
            'amount' => $this->faker->randomFloat()
        ];
    }
}
