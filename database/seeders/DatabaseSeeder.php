<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store\Category;
use App\Models\Store\Product;
use App\Models\Store\Order;
use App\Models\Store\Cart;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create categories
        Category::factory(5)->create();

        // Create the guest user
        User::factory()->hasCart()->create([
            'name' => 'guest',
            'email' => 'guest@example.com'
        ]);

        // Create users and attach its to the cart
        User::factory(5)->hasCart()->create();

        // Create products
        $products = Product::factory(6)->create();

        // Create orders
        Order::factory(rand(1, 10))->create();

        // Fill the 'order_user' intermediate table
        $usersIds = User::pluck("id")->toArray();

        foreach (Order::all() as $order) {
            $ids = $usersIds;
            $ids_id = rand(0, count($ids) - 1);
            $id = $ids[$ids_id];
            unset($ids[$ids_id]);

            $order->users()->attach($id);
        }

        // Fill the 'cart_product' intermediate table
        $cart = Cart::find(1);

        // Create one Cart record for the testing purpose
        $product = $products->random();
        $cart->products()->attach([$product->id => ['quantity' => rand(1, $product->amount)]]);

        // Fill the 'order_product' intermediate table
        $orderProducts = $products->random(3);

        foreach (Order::all() as $order) {
            foreach ($orderProducts->random(3) as $product) {
                $qnty = rand(1, $product->amount >= 10 ? 10 : $product->amount);
                $order->products()->attach([
                    $product->id => [
                        'price' => $product->price * $qnty,
                        'quantity' => $qnty
                    ]
                ]);
            }
        }
    }
}
