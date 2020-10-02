<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Suavy\LojaForLaravel\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function index(PaymentRequest $request)
    {
        dd('ok');
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
