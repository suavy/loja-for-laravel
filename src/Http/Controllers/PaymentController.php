<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Stripe\Checkout\Session;
use Stripe\Event;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Suavy\LojaForLaravel\Http\Requests\PaymentRequest;
use Suavy\LojaForLaravel\Models\Order;

class PaymentController extends Controller
{
    // Todo à voir avec Matthieu
    // Todo remove this
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

        return view('loja::cart.payment', compact('cartItems', 'paymentIntent'));
    }

    // Todo à voir avec Matthieu
    public function createCheckoutSession()
    {
        if (\Cart::session(session()->getId())->isEmpty()) {
            return back();
        }
        $cartItems = \Cart::session(session()->getId())->getContent();
        Stripe::setApiKey(config('services.stripe.secret'));
        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => 2000,
                        'product_data' => [
                            'name' => 'Stubborn Attachments',
                            'images' => ['https://i.imgur.com/EHyR2nP.png'],
                        ],
                    ],
                    'quantity' => 1,
                ],
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => 1000,
                        'product_data' => [
                            'name' => 'Stubborn Attachments',
                            'images' => ['https://i.imgur.com/EHyR2nP.png'],
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('loja.payment.success'),
            'cancel_url' => route('loja.payment.cancel'),
        ]);

        return response()->json(['id' => $checkoutSession->id]);
    }

    // Todo à voir avec Matthieu
    public function success()
    {
        \Cart::session(session()->getId())->clear(); //empty cart after payment
        dd('success');
    }

    // Todo à voir avec Matthieu
    public function cancel()
    {
        dd('cancel');
    }

    // Todo à voir avec Matthieu
    // todo : Webhook qui écoute les events de Stripe
    // https://stripe.com/docs/webhooks/integration-builder
    // todo : en fonction de l'event changer le statut de l'order / envoyer email / etc
    // TODO IMPORTANT : update webhook to https://stripe.com/docs/payments/checkout/fulfill-orders "checkout.session.completed" au lieux de "payment_intent"
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
