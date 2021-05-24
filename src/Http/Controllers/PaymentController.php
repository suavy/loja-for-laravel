<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Stripe\Checkout\Session;
use Stripe\Event;
use Stripe\Stripe;
use Suavy\LojaForLaravel\Models\Order;

class PaymentController extends Controller
{
    // Todo needs updates
    public function createCheckoutSession()
    {
        //  Order::initOrder($paymentIntent); // todo fix this function
        if (\Cart::session(session()->getId())->isEmpty()) {
            return back(); // todo fix this, do not work anymore cause createCheckoutSession is called on JS
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach(\Cart::session(session()->getId())->getContent() as $item){
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $item->price, //todo j'ai un doute sur le prix
                    'product_data' => [
                        'name' => $item->name,
                        'images' => [$item->associatedModel->cover],
                    ],
                ],
                'quantity' => (int) $item->quantity,
            ];
        }

        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('loja.payment.success'),
            'cancel_url' => route('loja.payment.cancel'),
        ]);

        return response()->json(['id' => $checkoutSession->id]);
    }

    public function success()
    {
        \Cart::session(session()->getId())->clear(); //empty cart after payment // todo fix ?

        return view('loja::cart.payment-success');
    }

    public function cancel()
    {
        return redirect(route('loja.cart.index'));
    }

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
