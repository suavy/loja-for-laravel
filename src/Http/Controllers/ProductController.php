<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Suavy\LojaForLaravel\Models\Product;

class ProductController extends Controller
{
    public function show()
    {
        $product = new Product();
        return view('loja-for-laravel::product.show', compact('product'));
    }
}
