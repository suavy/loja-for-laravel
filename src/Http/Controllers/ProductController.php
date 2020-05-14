<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Suavy\LojaForLaravel\Events\ProductWasShown;
use Suavy\LojaForLaravel\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::query()->findOrFail($id);
        event(new ProductWasShown($product));
        return view('loja::product.show', compact('product'));
    }
}
