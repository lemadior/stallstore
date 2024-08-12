<?php

namespace App\Services\Store;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Store\Order;
use App\Models\User;
use RuntimeException;
use Exception;

class OrderService
{
    public function getUserId(string $name = 'guest'): int|null
    {
        return User::where('name', $name)->first()->id ?? null;
    }

    public function getNewOrderSerialNumber(): string
    {
        return fake()->unique()->regexify('#[A-Za-z0-9]{2}-[A-Za-z0-9]{10}') ?? '';
    }

    public function createNewOrder(array $productsData, int $userId = 1): Order
    {
        $data = [];

        $data['serial'] = $this->getNewOrderSerialNumber();
        $data['status'] = 0;

        try {
            $order = Order::create($data);
            $order->save();

            $order->users()->attach($userId);

            $this->addOrderProducts($productsData, $order);

            return $order;
        } catch (Exception $err) {
            throw new RuntimeException('Error Order creation: ' . $err->getMessage());
        }
    }

    public function getOrderProducts(Order $order): array
    {
        $productsData = [];

        foreach ($order->products as $product) {
            $productsData[$product->id]['name'] = $product->name;
            $productsData[$product->id]['sku'] = $product->sku;
            $productsData[$product->id]['quantity'] = $product->pivot->quantity;
            $productsData[$product->id]['total'] = $product->pivot->price;
        }

        return $productsData;
    }

    public function getOrdersData(Collection $orders): array
    {
        $ordersData = [];

        foreach ($orders as $order) {
            $user = $order->users->first();

            $ordersData[$order->id]['serial'] = $order->serial;
            $ordersData[$order->id]['name'] = $user->name;
            $ordersData[$order->id]['phone'] = $user->phone;
            $ordersData[$order->id]['email'] = $user->email;
            $ordersData[$order->id]['summary'] = $this->getProductsSummary($order->products);
            $ordersData[$order->id]['date'] = $order->created_at->format('Y-m-d');
        }

        return $ordersData;
    }

    protected function getProductsSummary(Collection $products): int
    {
        $summary = 0;

        foreach ($products as $product) {
            $summary += $product->price;
        }

        return $summary;
    }

    public function addOrderProducts(array $productsData, Order $order): void
    {
        foreach ($productsData as $productId => $product) {
            $order->products()->attach([
                $productId => [
                    'price' => $product['total'],
                    'quantity' => $product['quantity']
                ]
            ]);
        }
    }
}
