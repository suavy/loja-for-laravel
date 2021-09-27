<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Suavy\LojaForLaravel\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->where('user_id',auth()->user()->id)->get();

        return view('loja::order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('loja::order.show', compact('order'));
    }
}
