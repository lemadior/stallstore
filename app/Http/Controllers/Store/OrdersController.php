<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Services\Store\OrderService;
use App\Models\Store\Order;
use App\Models\User;
use Inertia\Inertia;

class OrdersController extends Controller
{
    protected OrderService $orderService;

    protected int $userId;

    public function __construct(string $userName = 'guest')
    {
        $this->orderService = app(OrderService::class);
        $this->userId = User::query()->where('name', $userName)->first()->id;
    }

    public function show()
    {
        $orders = Order::with('users')->with('products')->get();
        $ordersData = $this->orderService->getOrdersData($orders);

        return Inertia::render("Store/Orders", ['ordersData' => $ordersData]);
    }

    public function showOrder(Order $order)
    {
        $productsData = $this->orderService->getOrderProducts($order);

        $user = $order->users->first();

        return Inertia::render("Store/Order", [
            'order' => $order,
            'productsData' => $productsData,
            'user' => $user
        ]);
    }

    public function deleteOrder(Order $order)
    {
        $serial = $order->serial;
        $order->delete();

        return redirect()->route('orders.show')->with('success', 'Order ' . $serial . ' has been deleted');
    }
}
