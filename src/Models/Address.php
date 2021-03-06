<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Address extends Model
{
    use CrudTrait;

    protected $table = 'loja_addresses';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getReadableAttribute()
    {
        return " {$this->street} {$this->zip_code} {$this->city}";
    }

    public function getReadableOtherAttribute()
    {
        return is_null($this->other) ? 'Non précisé' : $this->other;
    }
}
