<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Services\Store\CartService;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Exception;

class CartController extends Controller
{
    protected CartService $service;
    protected int $userId;

    public function __construct(string $userName = 'guest')
    {
        $this->service = app(CartService::class);
        $this->userId = User::query()->where('name', $userName)->first()->id;
    }
    public function show()
    {
        $productsData = $this->service->getCartProducts($this->userId);

        return Inertia::render('Store/Cart', ['productsData' => $productsData]);
    }

    public function store(Request $request)
    {
        $productId = $request->query('product_id');

        $quantity = $request->query('quantity');

        try {
            $this->service->addProductToCart($productId, $quantity, $this->userId);
        } catch (Exception $err) {
            return redirect(route('category'))->with('error', "Product cannot be added to the cart: " . $err->getMessage());
        }

        return redirect()->back()->with('success', "Product has been added to the cart");
    }

    public function delete(Request $request)
    {
        $productId = $request->query('product_id');

        try {
            $this->service->deleteProductFromCart($productId, $this->userId);
        } catch (Exception $err) {
            return redirect()->back()->with('error', "Product cannot be deleted: " . $err->getMessage());
        }

        return redirect()->back()->with('success', "Product has been deleted from cart successfully");
    }

    public function patch(Request $request)
    {
        $productId = $request->query('product_id');

        $quantity = $request->query('quantity');

        try {
            $this->service->updateProductOnCart($productId, $quantity, $this->userId);
        } catch (Exception $err) {
            return redirect()->back()->with('error', "The cart data cannot be updated: " . $err->getMessage());
        }

        return redirect()->route('cart.show')->with('success', "The cart has been updated successfully");
    }
}
