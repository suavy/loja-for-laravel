<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Suavy\LojaForLaravel\Traits\HasSlug;

class Collection extends Model
{
    use CrudTrait;
    use HasPackageFactory;
    use HasSlug;

    protected $table = 'loja_collections';
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
