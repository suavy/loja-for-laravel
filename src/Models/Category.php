<?php

namespace Suavy\LojaForLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "loja_categories";
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
