<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Suavy\LojaForLaravel\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        if (auth()->guest()) {
            session(['url.intended' => route('loja.cart.index')]);
        }

        return view('loja::cart.index');
    }

    public function productAdd(Product $product, Request $request)
    {
        $attributeValues = $request->input('attribute_values', []);

        $quantity = $request->input('quantity');

        if (! $product->hasEnoughQuantityAvailable($quantity)) {
            return response()->json(['status' => 'error', 'message' => "la quantitée demandé n'est pas disponible"]);
        }

        if (! $product->hasEnoughQuantityMaximum($quantity)) {
            return response()->json(['status' => 'error', 'message' => 'Désolé, vous avez ajouté la quantitée maximum pour ce produit.']);
        }

        $product->cartAdd($quantity, $attributeValues);

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
