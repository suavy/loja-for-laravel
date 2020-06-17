<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Former\Facades\Former;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Suavy\LojaForLaravel\Http\Requests\PaymentRequest;
use Suavy\LojaForLaravel\Models\Address;
use Suavy\LojaForLaravel\Models\Product;

class PaymentController extends Controller
{

    public function index(PaymentRequest $request)
    {
        if ($request->has('address')) {
            Auth::user()->updateAddress($request->input('address'));
            return back();
        }

        $cartItems = \Cart::session(session()->getId())->getContent();
        $cartItemsProblemQuantity = collect();
        $cartItemsRemoved = collect();
        if (\Cart::session(session()->getId())->isEmpty()) {
            return back();
        } else {
            return view('loja::cart.payment', compact('cartItems'));
        }
    }


}
