<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Suavy\LojaForLaravel\Http\Controllers\Controller;
use Suavy\LojaForLaravel\Models\Order;
use Suavy\LojaForLaravel\Models\OrderStatus;
use Suavy\LojaForLaravel\Notifications\OrderSent;

class AdminController extends Controller
{
    /**
     * View an order and confirm it.
     */
    public function confirmOrder()
    {
        $order = Order::query()->findOrFail(request()->input('order'));

        if ($order->orderStatus->slug !== OrderStatus::PROCESSED) {
            return redirect()->back();
        }

        $order->delivery_tracking = request()->input('delivery_tracking');

        $order->setStatusSent();

        $order->save();

        $order->user->notify(new OrderSent($order));

        return redirect(backpack_url('order?status=2')) //http://lucilevilaine.local/admin/order?status=2
            ->with('success', 'La commande a bien été confirmé');
    }
}
