<?php

namespace Database\Factories\Store;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store\Order>
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
            'serial' => fake()->unique()->regexify('#[A-Za-z0-9]{2}-[A-Za-z0-9]{10}'),
            'status' => 0
        ];
    }
}
