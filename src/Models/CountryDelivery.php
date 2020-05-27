<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use PragmaRX\Countries\Package\Countries;

class CountryDelivery extends Model
{
    use CrudTrait;

    protected $table = 'loja_country_deliveries';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    public function getNameAttribute(){
        return (new Countries())->where('cca2',$this->cca2)->first()->name->common;
    }

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */
    public static function countriesCca2(){
        return self::all()->pluck('cca2');
    }

    public static function countriesNotSelected(){
        $countriesCca2ToIgnore = self::countriesCca2();
        return (new Countries())->all()->filter(function ($value) use ($countriesCca2ToIgnore){
            return ! ($countriesCca2ToIgnore->contains($value->cca2));
        })->pluck('name.common','cca2')->toArray();

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
