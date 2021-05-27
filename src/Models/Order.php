<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Suavy\LojaForLaravel\Notifications\OrderPaid;

class Order extends Model
{
    use CrudTrait;

    protected $table = 'loja_orders';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price', 'price_with_tax');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */
    public static function initOrder($stripeId)
    {
        $order = self::create([
            'user_id' => Auth::id(),
            'order_status_id' => 1, // pending
            'stripe_id' => $stripeId,
        ]);
        // todo complete loja_order_... tables
        return $order;
    }

    public static function handlePaymentIntentSucceeded(PaymentIntent $paymentIntent)
    {
        // update order_status_id to "processed"
        self::query()->where('stripe_id', $paymentIntent->id)->update(['order_status_id' => 2]);
        // retrieve order user and send him a notification
        $order = self::query()->where('stripe_payment_intent_id', $paymentIntent->id)->with('user')->first();
        $user = $order->user;
        $user->notify(new OrderPaid());
    }

    public static function handlePaymentIntentCanceled(PaymentIntent $paymentIntent)
    {
        // update order_status_id to "canceled"
        self::query()->where('stripe_id', $paymentIntent->id)->update(['order_status_id' => 3]);
    }

    public static function handlePaymentIntentPaymentFailed(PaymentIntent $paymentIntent)
    {
        // update order_status_id to "payment-failed"
        self::query()->where('stripe_id', $paymentIntent->id)->update(['order_status_id' => 4]);
    }
}
