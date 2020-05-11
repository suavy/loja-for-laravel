<?php

use Illuminate\Support\Facades\Route;
use Suavy\LojaForLaravel\Http\Controllers\CartController;
use Suavy\LojaForLaravel\Http\Controllers\CategoryController;
use Suavy\LojaForLaravel\Http\Controllers\CollectionController;
use Suavy\LojaForLaravel\Http\Controllers\HomeController;
use Suavy\LojaForLaravel\Http\Controllers\OrderController;
use Suavy\LojaForLaravel\Http\Controllers\ProductController;
use Suavy\LojaForLaravel\Http\Controllers\SearchController;

Route::get('/', [HomeController::class, 'index'])->name('loja.home');

/*
 * Product, Category, Collection routing
 */
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('loja.category.show');
Route::get('/collection/{collection}', [CollectionController::class, 'show'])->name('loja.collection.show');
Route::get('/search', [SearchController::class, 'search'])->name('loja.search');

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
Route::post('/cart/empty', [CartController::class, 'empty'])->name('loja.cart.empty');
