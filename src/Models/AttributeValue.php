<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use CrudTrait;

    protected $table = 'loja_attribute_values';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
    public function getReadableAttribute()
    {
        return $this->attribute->name.' : '.strtolower($this->value);
    }
}
