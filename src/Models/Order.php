<?php

namespace Suavy\LojaForLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "loja_orders";
    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price', 'price_with_tax');
    }
}
