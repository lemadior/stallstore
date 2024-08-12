<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $imageUrl = asset('storage/' . $product->image);

        return Inertia::render("Store/Product", ['product' => $product, 'imageUrl' => $imageUrl]);
    }
}
