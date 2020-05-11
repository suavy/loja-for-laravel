<?php

namespace Suavy\LojaForLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = "loja_order_statuses";
    // Disable Laravel's mass assignment protection
    protected $guarded = [];
}
