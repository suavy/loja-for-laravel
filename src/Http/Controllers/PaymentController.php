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
        if (\Cart::session(session()->getId())->isEmpty()) {
            return back(); // todo fix this, do not work anymore cause createCheckoutSession is called on JS
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach (\Cart::session(session()->getId())->getContent() as $item) {
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
            'customer_email' => \Auth::user()->email,
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('loja.payment.success'),
            'cancel_url' => route('loja.payment.cancel'),
        ]);

        Order::initOrder($checkoutSession->id);

        return response()->json(['id' => $checkoutSession->id]);
    }

    public function success()
    {
        \Cart::session(session()->getId())->clear();

        return view('loja::cart.payment-success');
    }

    public function cancel()
    {
        // todo find a way to make this working
        //Order::handleCheckoutSessionCanceled();
        return redirect(route('loja.cart.index'));
    }

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
            case 'checkout.session.completed':
                Order::handleCheckoutSessionCompleted($event->data->object);
                break;
            default:
                echo 'Received unknown event type';
        }
        http_response_code(200);
    }
}
