<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Suavy\LojaForLaravel\Database\Factories\CollectionFactory;
use Suavy\LojaForLaravel\Traits\HasSlug;
use function Symfony\Component\String\s;

class Collection extends Model
{
    use CrudTrait;
    use HasFactory;
    use HasSlug;

    protected $table = 'loja_collections';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];


    public $fillable = ['id', 'name', 'description', 'slug', 'cover', 'lft', 'rgt', 'depth',
        'parent_id', 'enabled', 'enabled_home_page', 'created_at', 'updated_at'];

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
    public function scopeEnabledHomePage($query)
    {
        $query->where('enabled_home_page', true);
    }

    public function scopeEnabled($query)
    {
        $query->where('enabled', true);
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

    /**
     * Get collection enabled for homepage.
     */
    public static function getForHome()
    {
        return
            self::query()
            ->enabledHomePage()
            ->orderBy('lft')
            ->get();
    }

    /**
     * Get cover of collection.
     * @return string
     */
    public function getCover()
    {
        if (! is_null($this->cover)) {
            return asset($this->cover);
        } else {
            return asset('images/photo-non-disponible.jpg');
        }
    }
}
