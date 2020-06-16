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


    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */

    public static function forSelect(){
        $query = self::query()->select(['name','id']);
        if(\Config::get('settings.delibery_to_all_countries')){
            $query = $query->get();
        }else{
            $query = $query->where('delivery',1)->get();
        }
        return $query->pluck('name','id');
    }

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
    }
}
