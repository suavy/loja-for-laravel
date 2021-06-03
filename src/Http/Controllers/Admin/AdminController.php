<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Suavy\LojaForLaravel\Http\Controllers\Controller;
use Suavy\LojaForLaravel\Models\Order;

class AdminController extends Controller
{
    /**
     * View an order and confirm it.
     */
    public function confirmOrder(Order $order)
    {
        dd($order);
    }
}
