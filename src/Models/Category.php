<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Suavy\LojaForLaravel\Database\Factories\CategoryFactory;
use Suavy\LojaForLaravel\Traits\HasSlug;

class Category extends Model
{
    use CrudTrait;
    use HasFactory;
    use HasSlug;

    protected $table = 'loja_categories';
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

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */
    protected static function newFactory() {
        return CategoryFactory::new();
    }

}
