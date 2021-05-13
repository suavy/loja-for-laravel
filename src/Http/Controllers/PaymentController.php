<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Stripe\Event;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Suavy\LojaForLaravel\Http\Requests\PaymentRequest;
use Suavy\LojaForLaravel\Models\Order;

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
        Stripe::setApiKey(config('services.stripe.secret'));
        $paymentIntent = PaymentIntent::create([
            'amount' => $orderAmount,
            'currency' => 'eur',
        ]);
        Order::initOrder($paymentIntent); // todo complete this function

        \Cart::session(session()->getId())->clear(); //empty cart after payment

        return view('loja::cart.payment', compact('cartItems', 'paymentIntent'));
    }

    // todo : Webhook qui écoute les events de Stripe
    // https://stripe.com/docs/webhooks/integration-builder
    // todo : en fonction de l'event changer le statut de l'order / envoyer email / etc
    public function webhook()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $payload = @file_get_contents('php://input');
        $event = null;
        try {
            $event = Event::constructFrom(
                json_decode($payload, true)
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            echo '⚠️  Webhook error while parsing basic request.';
            http_response_code(400);
            exit();
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
                // Then define and call a method to handle the successful payment intent.
                // handlePaymentIntentSucceeded($paymentIntent);
                Order::handlePaymentIntentSucceeded($paymentIntent);
                break;
            case 'payment_method.attached':
                $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
                // Then define and call a method to handle the successful attachment of a PaymentMethod.
                // handlePaymentMethodAttached($paymentMethod);
                break;
            default:
                // Unexpected event type
                echo 'Received unknown event type';
        }
        http_response_code(200);
    }
}
