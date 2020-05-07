<?php

use Illuminate\Support\Facades\Route;
use Suavy\LojaForLaravel\Http\Controllers\ProductController;
use Suavy\LojaForLaravel\Http\Controllers\CartController;

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
