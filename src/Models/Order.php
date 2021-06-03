<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
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
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price', 'price_with_tax');
    }

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
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
            'order_status_id' => OrderStatus::$STATUS_PENDING, // pending
            'stripe_id' => $stripeId,
            'amount' => 0,
        ]);
        // todo complete loja_order_... tables
        return $order;
    }

    // todo clean this
    public static function handleCheckoutSessionCompleted(Session $checkoutSession)
    {
        self::query()->where('stripe_id', $checkoutSession->id)->update(['order_status_id' => OrderStatus::$STATUS_PROCESSED]);
        // retrieve order user and send him a notification
        $order = self::query()->where('stripe_id', $checkoutSession->id)->with('user')->first();
        if (optional($order)->user) {
            $order->user->notify(new OrderPaid());
        }
    }
}
