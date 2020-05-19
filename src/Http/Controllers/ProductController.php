<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Suavy\LojaForLaravel\Events\ProductWasShown;
use Suavy\LojaForLaravel\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        event(new ProductWasShown($product));

        return view('loja::product.show', compact('product'));
    }
}
