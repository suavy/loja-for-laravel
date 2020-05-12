<?php

namespace Suavy\LojaForLaravel\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use CrudTrait;

    protected $table = 'loja_taxes';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];
}
