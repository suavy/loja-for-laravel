<?php

use Illuminate\Support\Facades\Route;
use Suavy\LojaForLaravel\Http\Controllers\CartController;
use Suavy\LojaForLaravel\Http\Controllers\CategoryController;
use Suavy\LojaForLaravel\Http\Controllers\CollectionController;
use Suavy\LojaForLaravel\Http\Controllers\OrderController;
use Suavy\LojaForLaravel\Http\Controllers\PaymentController;
use Suavy\LojaForLaravel\Http\Controllers\ProductController;
use Suavy\LojaForLaravel\Http\Controllers\SearchController;

Route::group([
    'middleware' => 'web',
    'prefix' => config('loja.prefix'),
], function () {
    /*
     * Product, Category, Collection routing
     */
    Route::get('/product/{product}', [ProductController::class, 'show'])->name('loja.product.show');
    Route::get('/categories', [CategoryController::class, 'index'])->name('loja.category.index');
    Route::get('/category/{category}', [CategoryController::class, 'show'])->name('loja.category.show');
    Route::get('/collections', [CollectionController::class, 'index'])->name('loja.collection.index');
    Route::get('/collection/{collection}', [CollectionController::class, 'show'])->name('loja.collection.show');
    Route::get('/search', [SearchController::class, 'index'])->name('loja.search');

    /*
     * Order routing
     */
    Route::get('/user/orders', [OrderController::class, 'index'])->name('loja.order.index');
    Route::get('/user/order/{order}', [OrderController::class, 'show'])->name('loja.order.show');

    /*
     * Cart routing
     */
    Route::get('/cart', [CartController::class, 'index'])->name('loja.cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'productAdd'])->name('loja.cart.product.add');
    Route::post('/cart/update/{product}', [CartController::class, 'productUpdateQuantity'])->name('loja.cart.product.update.quantity');
    Route::post('/cart/remove/{product}', [CartController::class, 'productRemove'])->name('loja.cart.product.remove');
    Route::get('/cart/empty', [CartController::class, 'empty'])->name('loja.cart.empty');

    /*
     * Payment routing
     */
    Route::post('/payment', [PaymentController::class, 'index'])->name('loja.payment.index');
    Route::post('stripe/webhook', [PaymentController::class, 'webhook'])->name('loja.payment.webhook');
});
