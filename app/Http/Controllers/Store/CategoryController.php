<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store\Category;
use App\Models\Store\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $currentCategory = $request->query('name') ?? 'all';

        $categoryId = null;

        if ($currentCategory !== 'all') {
            $categoryId = Category::query()->where('name', ucfirst($currentCategory))->first()->id;
        }

        $products = $categoryId
            ? Product::query()->where('category_id', $categoryId)->get(['id', 'name', 'image', 'price', 'archive'])
            : Product::all(['id', 'name', 'image', 'price', 'archive']);

        return Inertia::render('Store/Category', [
            'current' => $currentCategory ?? 'all',
            'products' => $products,
        ]);
    }
}
