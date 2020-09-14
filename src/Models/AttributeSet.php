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

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
}
