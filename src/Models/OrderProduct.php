<?php

namespace Suavy\LojaForLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'loja_order_products';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'loja_order_product_attribute_value');
    }
}
