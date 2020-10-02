<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Cartalyst\Stripe\Api\PaymentIntents;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Suavy\LojaForLaravel\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function index(PaymentRequest $request)
    {

        if ($request->has('address')) {
            Auth::user()->updateAddress($request->input('address'));
            //return back();
        }
        if (\Cart::session(session()->getId())->isEmpty()) {
            return back();
        }
        $cartItems = \Cart::session(session()->getId())->getContent();
        $cartItemsProblemQuantity = collect();
        $cartItemsRemoved = collect();
        $orderAmount = 200;
        $stripe = new Stripe(config('services.stripe.secret'));
        $paymentIntent = $stripe->paymentIntents()->create([
            'amount' => $orderAmount,
            'currency' => 'eur',
            'payment_method_types' => [
                'card',
            ],
        ]);
        return view('loja::cart.payment', compact('cartItems', 'paymentIntent'));

    }

    public function charge(Request $request)
    {
        dd($request->input('stripeToken'));
    }
}
