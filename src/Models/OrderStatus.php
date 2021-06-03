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



    public static $STATUS_PENDING = 1;
    public static $STATUS_PROCESSED = 2;
    public static $STATUS_CANCELED = 3;
    public static $STATUS_DELIVERED = 4;
}
