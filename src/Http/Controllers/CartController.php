<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Suavy\LojaForLaravel\Models\Product;

class CartController extends Controller
{
    public function empty(Request $request)
    {
        \Cart::session(session()->getId())->clear();
        return response()->json(['status' => 'success'], 200);
    }

    public function index()
    {
        $cartItems = \Cart::session(session()->getId())->getContent();

        return view('loja::cart.index', compact('cartItems'));
    }

    public function productAdd(Product $product, Request $request)
    {
        $quantity = $request->input('quantity');
        //dd($product->id,$quantity);


        //todo check quantity $product->hasEnoughQuantity($quantity)
        //todo return response()->json(['status' => 'error','message' => "la quantitée demandé n'est pas disponible"],500);

        $product->cartAdd($quantity);

        //if problem
        //return response()->json(['error' => 'invalid'], 401);

        //if everything is ok
        //todo return new quantity available
        return response()->json(['status' => 'success'], 200);
    }

    public function productUpdateQuantity(Product $product, Request $request)
    {
        if($request->input('update_mode') == "add")
            $product->cartAddQuantity();
        else
            $product->cartLessQuantity();

        return response()->json(['status' => 'success','subTotal'=>\Cart::getTotal()], 200);
    }

    public function productRemove(Product $product)
    {
        $product->cartRemove();


        return response()->json(['status' => 'success','subTotal'=>\Cart::getTotal()], 200);
    }
}
