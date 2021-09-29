<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Suavy\LojaForLaravel\Notifications\OrderPaid;

class Order extends Model
{
    use CrudTrait;
    use HasFactory;

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
        return $this->belongsToMany(Product::class, 'loja_order_product')->withPivot('quantity', 'price', 'price_with_tax');
    }

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    // this user relation was added to fix a bug on EAP
    /*public function user()
    {
        return $this->belongsTo(\Suavy\LojaForLaravel\Models\User::class);
    }*/
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
    public function getReadableProductsAttribute()
    {
        return $this->products->pluck('name')->implode(', ');
    }

    public function getReadableOrderStatusAttribute()
    {
        if ($this->orderStatus) {
            return $this->orderStatus->readable_order_status;
        } else {
            return __('loja::order.not-defined');
        }
    }

    public function getDeliveryTrackingReadableAttribute()
    {
        //todo save address in order
        return "https://www.chronopost.fr/expedier/inputLTNumbersNoJahia.do?listeNumeros=".$this->delivery_tracking;

    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function getReadablePriceAttribute()
    {
        return loja_price_readable($this->amount).'€';
    }

    public function scopeProcessed($query)
    {
        return $query->whereHas('orderStatus', function ($query) {
            $query->processed();
        });
    }

    public function scopeSent($query)
    {
        return $query->whereHas('orderStatus', function ($query) {
            $query->sent();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */

    /**
     * Défini le status de la commande a envoyé (sent).
     */
    public function setStatusSent()
    {
        $this->orderStatus()->associate(OrderStatus::getSent());
    }

    public function isSent()
    {
        return !is_null($this->orderStatus) && $this->orderStatus->slug == "sent";
    }

    public static function initOrder($stripeId, $amount, $items)
    {
        $order = self::create([
            'user_id' => Auth::id(),
            'order_status_id' => OrderStatus::$STATUS_PENDING, // pending
            'stripe_id' => $stripeId,
            'amount' => $amount,
        ]);

        foreach ($items as $item) {
            $orderProduct = new OrderProduct([
                'order_id'      => $order->id,
                'product_id'    => $item->associatedModel->id,
                'quantity'      => $item->quantity,
                'price'         => $item->price,
            ]);

            $orderProduct->save();

            $orderProduct->attributeValues()->attach($item->attributes->keys());
        }

        return $order;
    }

    // todo clean this
    public static function handleCheckoutSessionCompleted(Session $checkoutSession)
    {
        self::query()->where('stripe_id', $checkoutSession->id)->update(['order_status_id' => OrderStatus::$STATUS_PROCESSED]);
        // retrieve order user and send him a notification
        $order = self::query()->where('stripe_id', $checkoutSession->id)->with('user')->first();
        if (optional($order)->user) {
            $order->user->notify(new OrderPaid($order));
        }
    }
}
