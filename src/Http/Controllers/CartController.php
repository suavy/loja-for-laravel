<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Illuminate\Http\Request;
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

    public function productAdd($id, Request $request)
    {
        //todo add request protection quantity etc
        $product = Product::query()->findOrFail($id);
        $quantity = $request->input('quantity');
        //dd($product->id,$quantity);

        //todo add to cart system

        //if problem
        //return response()->json(['error' => 'invalid'], 401);

        //if everything is ok
        //todo return new quantity available
        return response()->json(['success' => 'success'], 200);
    }

    public function productUpdateQuantity(Product $product, Request $request)
    {
    }

    public function productRemove(Product $product)
    {
    }
}
