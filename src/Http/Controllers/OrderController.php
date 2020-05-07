<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Suavy\LojaForLaravel\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->get();

        return view('loja::user.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('loja::user.order.show', compact('order'));
    }
}
