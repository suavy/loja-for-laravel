<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Suavy\LojaForLaravel\Traits\HasSlug;

class Product extends Model
{
    use CrudTrait;
    use HasSlug;

    protected $table = 'loja_products';

    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price', 'price_with_tax');
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
}
