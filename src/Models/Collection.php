<?php

namespace Suavy\LojaForLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = "loja_collections";
    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
