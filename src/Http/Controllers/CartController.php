<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Suavy\LojaForLaravel\Http\Requests\CartRequest;
use Suavy\LojaForLaravel\Models\Product;

class CartController extends Controller
{

    public function empty(Request $request)
    {

    }

    public function index()
    {
        $cart = 'hello';

        return view('loja::cart.index', compact('cart'));
    }

    public function productAdd(Product $product,Request $request)
    {

    }

    public function productUpdateQuantity(Product $product,Request $request)
    {

    }

    public function productRemove(Product $product)
    {

    }


}
