<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Suavy\LojaForLaravel\Traits\HasSlug;
use Suavy\LojaForLaravel\Traits\Products\HasCart;

class Product extends Model
{
    use CrudTrait;
    use HasCart;
    use HasSlug;

    protected $table = 'loja_products';

    // Disable Laravel's mass assignment protection
    //protected $guarded = [];

    protected $fillable = ['id'];

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

    public function attributeSet()
    {
        return $this->belongsTo(AttributeSet::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */
}
