<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\Store\CheckoutRequest;
use App\Http\Controllers\Controller;
use App\Services\Store\CartService;
use App\Services\Store\OrderService;
use App\Models\Store\Cart;
use App\Models\User;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    protected CartService $cartService;
    protected OrderService $orderService;

    protected int $userId;

    public function __construct(string $userName = 'guest')
    {
        $this->cartService = app(CartService::class);
        $this->orderService = app(OrderService::class);
        $this->userId = User::query()->where('name', $userName)->first()->id;
    }
    public function show()
    {
        $productsData = $this->cartService->getCartProducts($this->userId);

        return Inertia::render("Store/Checkout", ['productsData' => $productsData]);
    }

    public function store(CheckoutRequest $request)
    {

        $data = $request->validated();
        $data['password'] = '*';

        $userCartId = $data['user_id'];
        unset($data['user_id']);

        $productsData = $data['products_data'];
        unset($data['products_data']);

        $user = User::firstOrCreate($data);
        Cart::create(['user_id' => $user->id]);

        $order = $this->orderService->createNewOrder($productsData, $user->id);

        $this->cartService->clearCart($userCartId);

        return redirect()->route('order.show', $order->id)->with('success', 'An order has been confirmed. Please wait for proceed.');
    }
}
