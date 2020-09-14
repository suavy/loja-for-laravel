<?php

namespace Suavy\LojaForLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
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
