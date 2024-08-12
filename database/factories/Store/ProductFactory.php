<?php

namespace Database\Factories\Store;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store\Category;
use Exception;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store\Product>
 */
class ProductFactory extends Factory
{
    protected const PRODUCT_IMAGES = [
        'Clothes' => ['images/image_test_1.jpg'],
        'Weapons' => ['images/image_test_2.jpg'],
        'Gadgets' => ['images/image_test_3.jpg'],
        'Electronics' => ['images/image_test_5.jpg'],
        'Kitchenwares' => ['images_image_test_4.jpg', 'images/image_test_6.jpg']
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryData = Category::all(['id', 'name'])->toArray();

        $tryCount = 0;
        $category = null;
        try {
            // At first create the product for all existent categories
            $category = fake()->unique()->randomElement($categoryData);
        } catch (Exception $e) {
            // Categories count less than products.
            //This will generate product data if all categories already created
            $category = $categoryData[fake()->randomKey($categoryData)];
        }

        $image = self::PRODUCT_IMAGES[$category['name']];

        return [
            'name' => fake()->sentence(2, true),
            'sku' => fake()->unique()->regexify('[0-9]{12}'),
            'description' => fake()->sentence(30, true),
            'image' => $image[rand(0, count($image) - 1)],
            'price' => fake()->randomNumber(2, 4),
            'amount' => fake()->randomNumber(2, true),
            'archive' => false,
            'category_id' => $category['id']
        ];
    }
}
