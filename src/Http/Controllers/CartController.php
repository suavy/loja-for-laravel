<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Suavy\LojaForLaravel\Http\Requests\CartRequest;

class CartController extends Controller
{
    public function add($product, CartRequest $request)
    {
        dd(loja_products());
        dd("add ".$product);
    }
}
