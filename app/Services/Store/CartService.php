<?php

namespace App\Services\Store;

use App\Models\Store\Cart;
use App\Models\Store\Product;
use App\Models\User;

class CartService
{
    public function isGuestOnCart(): bool
    {
        $guestId = User::where('name', 'guest')->first()->id;

        $cart = Cart::where('user_id', $guestId);

        return !!$cart;
    }

    public function getUserCart(int $userId): Cart
    {
        return Cart::with('products')->where('user_id', $userId)->first();
    }

    public function getUserId(string $name): int|null
    {
        return User::where('name', $name)->first()->id ?? null;
    }

    public function getCartProducts(int $userId = 1): array
    {
        $productsData = [];

        $cart = $this->getUserCart($userId);

        foreach ($cart->products as $product) {
            $qnty = $product->pivot->quantity;

            $productsData[$product->id]['name'] = $product->name;
            $productsData[$product->id]['sku'] = $product->sku;
            $productsData[$product->id]['image'] = asset('storage/' . $product->image);
            $productsData[$product->id]['price'] = $product->price;
            $productsData[$product->id]['quantity'] = $qnty;
            $productsData[$product->id]['total'] = $qnty * $product->price;
        }

        return $productsData;
    }

    public function getCartProductsCount(int $userId = 1): int
    {
        return count($this->getCartProducts($userId));
    }

    public function addProductToCart($productId, int $quantity, int $userId): void
    {
        $cart = $this->getUserCart($userId);

        $cart->products()->attach([$productId => ['quantity' => $quantity]]);
    }

    public function deleteProductFromCart(int $productId, int $userId)
    {
        $cart = $this->getUserCart($userId);

        $cart->products()->detach($productId);
    }

    public function updateProductOnCart(int $productId, int $quantity, int $userId)
    {
        $cart = $this->getUserCart($userId);
        $productAmount = Product::query()->find($productId)->amount;

        $productQuantity = $quantity <= $productAmount ? $quantity : $productAmount;

        $cart->products()->updateExistingPivot($productId, ['quantity' => $productQuantity]);
    }

    public function clearCart(int $userId): void
    {
        $cart = $this->getUserCart($userId);

        foreach ($cart->products as $product) {
            $cart->products()->detach($product->id);
        }
    }
}
