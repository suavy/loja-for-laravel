<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Suavy\LojaForLaravel\Events\ProductWasShown;
use Suavy\LojaForLaravel\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        dd(session()->getId());
        dd(session('key'));
        $product = Product::query()->findOrFail($id);
        \Cart::add([
            [
                'id' => 456,
                'name' => 'Sample Item 1',
                'price' => 67.99,
                'quantity' => 4,
                'attributes' => [],
            ],
            [
                'id' => 568,
                'name' => 'Sample Item 2',
                'price' => 69.25,
                'quantity' => 4,
                'attributes' => [
                    'size' => 'L',
                    'color' => 'blue',
                ],
            ],
        ]);

        dd($items = \Cart::getContent());
        event(new ProductWasShown($product));

        return view('loja::product.show', compact('product'));
    }
}
