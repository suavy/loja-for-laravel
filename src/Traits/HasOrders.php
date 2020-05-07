<?php

namespace Suavy\LojaForLaravel\Traits;

use Suavy\LojaForLaravel\Models\Order;

trait HasOrders
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
