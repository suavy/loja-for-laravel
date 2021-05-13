<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Auth;
use Suavy\LojaForLaravel\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function index(PaymentRequest $request)
    {

        if (\Cart::session(session()->getId())->isEmpty()) {
            return back();
        }
        $cartItems = \Cart::session(session()->getId())->getContent();
        $cartItemsProblemQuantity = collect();
        $cartItemsRemoved = collect();
        $orderAmount = 200; // todo real order amount
        $stripe = new Stripe(config('services.stripe.secret'));
        $paymentIntent = $stripe->paymentIntents()->create([
            'amount' => $orderAmount,
            'currency' => 'eur',
        ]);
        // todo créer un "order" ici ?
        return view('loja::cart.payment', compact('cartItems', 'paymentIntent'));
    }

    // todo : Webhook qui écoute les events de Stripe
    // https://stripe.com/docs/webhooks/integration-builder
    // todo : en fonction de l'event changer le statut de l'order / envoyer email / etc
}
