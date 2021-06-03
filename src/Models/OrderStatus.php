<?php

namespace Suavy\LojaForLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'loja_order_statuses';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    const PROCESSED = "processed";
    const SENT = "sent";

    public function scopeProcessed($query)
    {
        return $query->where('slug',self::PROCESSED);
    }

    public function scopeSent($query)
    {
        return $query->where('slug',self::SENT);
    }


}
