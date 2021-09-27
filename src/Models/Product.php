<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Suavy\LojaForLaravel\Database\Factories\CollectionFactory;
use Suavy\LojaForLaravel\Traits\HasSlug;
use Suavy\LojaForLaravel\Traits\Products\HasCart;
use Suavy\LojaForLaravel\Traits\Products\HasImages;

class Product extends Model
{
    use CrudTrait;
    use HasCart;
    use HasFactory;
    use HasSlug;
    use HasImages;

    protected $table = 'loja_products';

    // Disable Laravel's mass assignment protection
    //protected $guarded = [];

    protected $fillable = ['id', 'name', 'sub_name', 'description', 'slug', 'stock', 'price', 'enabled', 'images', 'backoffice_price',
        'tax_id', 'category_id', 'collection_id', 'attribute_set_id', ];
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

    public function redirectToProductPage()
    {
        return '<a href="'.route('loja.product.show', $this->id).'" target="_blank">Voir la page</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | Accesors
    |--------------------------------------------------------------------------
    */
    public function getReadablePriceAttribute()
    {
        return number_format(($this->price / 100), 2, '.', ' ');
    }

    public function getBackofficePriceAttribute()
    {
        return $this->readable_price;
    }

    public function getNameTestAttribute()
    {
        //return $this->name.
    }

    public function getUrlAttribute()
    {
        return route('loja.product.show', $this);
    }

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

    public function setBackofficePriceAttribute($value)
    {
        $this->attributes['price'] = (int) ($value * 100);
    }

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */
    protected static function newFactory()
    {
        return CollectionFactory::new();
    }

    public function hasAttributes()
    {
        return $this->attributeSet && $this->attributeSet->attributes;
    }
}
