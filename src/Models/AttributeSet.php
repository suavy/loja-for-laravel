<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    use CrudTrait;

    protected $table = 'loja_attribute_sets';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];
    protected $fillable = ['id', 'type', 'name'];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'loja_attribute_attribute_set');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
