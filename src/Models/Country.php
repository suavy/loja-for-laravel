<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use PragmaRX\Countries\Package\Countries;

class Country extends Model
{
    use CrudTrait;

    protected $table = 'loja_countries';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    public function getNameAttribute()
    {
        return (new Countries())->where('cca2', $this->cca2)->first()->name->common;
    }

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */
    public static function countriesCca2()
    {
        return self::all()->pluck('cca2');
    }

    public static function countriesSeed()
    {
        $datas = [];
        $countries = (new Countries())->all()->pluck('name.common', 'cca2')->toArray();

        foreach ($countries as $key => $country) {
            $datas[] = [
                'cca2' => $key,
                'name' => $country,
            ];
        }

        self::query()->insert($datas);
        /*
        Doesnt work.. but better
        ->map(function($country){
            return [$country->cca2 => $country->name->common." - ".$country->cca2];
        })->values()->toArray()
        instead of
        ->pluck('name.common','cca2')
        */
    }
}
