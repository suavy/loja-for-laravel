<?php

use Illuminate\Support\Facades\Route;
use Suavy\LojaForLaravel\Http\Controllers\ProductController;

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
