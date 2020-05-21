<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Suavy\LojaForLaravel\Models\Product;

class CartController extends Controller
{
    public function empty(Request $request)
    {
        \Cart::session(session()->getId())->clear();

        return redirect()->route('loja.cart.index');
    }

    public function index()
    {
        if (\Cart::session(session()->getId())->isEmpty()) {
            return view('loja::cart.empty');
        } else {
            $cartItems = \Cart::session(session()->getId())->getContent();

            return view('loja::cart.index', compact('cartItems'));
        }
    }

    public function productAdd(Product $product, Request $request)
    {
        $quantity = $request->input('quantity');

        if (! $product->hasEnoughQuantityAvailable($quantity)) {
            return response()->json(['status' => 'error', 'message' => "la quantitée demandé n'est pas disponible"]);
        }

        if (! $product->hasEnoughQuantityMaximum($quantity)) {
            return response()->json(['status' => 'error', 'message' => 'Désolé, vous avez ajouté la quantitée maximum pour ce produit.']);
        }

        $product->cartAdd($quantity);

        return response()->json([
            'status' => 'success',
            'cartQuantity'=>\Cart::session(session()->getId())->getTotalQuantity(),
        ], 200);
    }

    public function productUpdateQuantity(Product $product, Request $request)
    {
        if ($request->input('update_mode') == 'add') {
            if (! $product->hasEnoughQuantityAvailable(+1)) {
                return response()->json(['status' => 'error', 'message' => "la quantitée demandé n'est pas disponible"]);
            }

            if (! $product->hasEnoughQuantityMaximum(+1)) {
                return response()->json(['status' => 'error', 'message' => 'Désolé, vous avez ajouté la quantitée maximum pour ce produit.']);
            }

            $product->cartAddQuantity();
        } else {
            $product->cartLessQuantity();
        }

        return response()->json([
            'status' => 'success',
            'subTotal'=>round(\Cart::getTotal(), 2),
            'cartQuantity'=>\Cart::session(session()->getId())->getTotalQuantity(),
        ], 200);
    }

    public function productRemove(Product $product)
    {
        $product->cartRemove();

        return response()->json([
            'status' => 'success',
            'subTotal'=>round(\Cart::getTotal(), 2),
            'cartQuantity'=>\Cart::session(session()->getId())->getTotalQuantity(), ], 200);
    }
}
