<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\CategoryController;
use App\Http\Controllers\Store\ProductController;
use App\Http\Controllers\Store\AboutController;
use App\Http\Controllers\Store\CheckoutController;
use App\Http\Controllers\Store\OrdersController;

Route::get('/', AboutController::class)->name('about');
Route::get('/category', [CategoryController::class, 'index'])->name('category');

Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/{product}', [ProductController::class, 'store'])->name('product.store');

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart', [CartController::class, 'delete'])->name('cart.delete');
Route::patch('/cart', [CartController::class, 'patch'])->name('cart.update');

Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/orders', [OrdersController::class, 'show'])->name('orders.show');
Route::get('/orders/{order}', [OrdersController::class, 'showOrder'])->name('order.show');
Route::delete('/orders/{order}', [OrdersController::class, 'deleteOrder'])->name('order.delete');
