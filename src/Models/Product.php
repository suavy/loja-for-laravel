<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Suavy\LojaForLaravel\Traits\HasSlug;
use Suavy\LojaForLaravel\Traits\Products\HasCart;
use Suavy\LojaForLaravel\Traits\Products\HasImages;

class Product extends Model
{
    use CrudTrait;
    use HasCart;
    use HasSlug;
    use HasImages;

    protected $table = 'loja_products';

    // Disable Laravel's mass assignment protection
    //protected $guarded = [];

    protected $fillable = ['id','name','description','slug','stock','price','enabled','images',
        'tax_id','category_id','collection_id','attribute_set_id'];
    protected $casts = ['images'=>'array'];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function attributeSet()
    {
        return $this->belongsTo(AttributeSet::class);
    }

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
    /*
    |--------------------------------------------------------------------------
    | Accesors
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */
}
