<?php

namespace Database\Factories\Store;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store\Category>
 */
class CategoryFactory extends Factory
{
    protected const PRODUCT_CATEGORIES = ['Clothes', 'Weapons', 'Gadgets', 'Electronics', 'Kitchenwares'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(self::PRODUCT_CATEGORIES)
        ];
    }
}
