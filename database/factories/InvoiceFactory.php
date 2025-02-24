<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'to_customer' => \App\Models\User::inRandomOrder()->first()->id,
            'total' => $this->faker->randomFloat(),
            'due_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['paid','pending'])
        ];
    }
}
