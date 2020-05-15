<?php

use Illuminate\Support\Facades\Route;
use Suavy\LojaForLaravel\Http\Controllers\CartController;
use Suavy\LojaForLaravel\Http\Controllers\CategoryController;
use Suavy\LojaForLaravel\Http\Controllers\CollectionController;
use Suavy\LojaForLaravel\Http\Controllers\HomeController;
use Suavy\LojaForLaravel\Http\Controllers\OrderController;
use Suavy\LojaForLaravel\Http\Controllers\ProductController;
use Suavy\LojaForLaravel\Http\Controllers\SearchController;

Route::group(['middleware' => 'web'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('loja.home');

    /*
     * Product, Category, Collection routing
     */
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('loja.product.show');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('loja.category.show');
    Route::get('/collection/{id}', [CollectionController::class, 'show'])->name('loja.collection.show');
    Route::get('/search', [SearchController::class, 'index'])->name('loja.search');

    /*
     * Order routing
     */
    Route::get('/user/orders', [OrderController::class, 'index'])->name('loja.order.index');
    Route::get('/user/order/{id}', [OrderController::class, 'show'])->name('loja.order.show');

    /*
     * Cart routing
     */
    Route::get('/cart', [CartController::class, 'index'])->name('loja.cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'productAdd'])->name('loja.cart.product.add');
    Route::post('/cart/update/{id}', [CartController::class, 'productUpdateQuantity'])->name('loja.cart.product.update.quantity');
    Route::post('/cart/remove/{id}', [CartController::class, 'productRemove'])->name('loja.cart.product.remove');
    Route::post('/cart/empty', [CartController::class, 'empty'])->name('loja.cart.empty');
});
