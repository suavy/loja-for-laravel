<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use CrudTrait;

    protected $table = 'loja_attributes';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function attributeSets()
    {
        return $this->belongsToMany(AttributeSet::class, 'loja_attribute_attribute_set');
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
