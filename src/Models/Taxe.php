<?php

namespace Suavy\LojaForLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Taxe extends Model
{
    protected $table = "loja_taxes";
    // Disable Laravel's mass assignment protection
    protected $guarded = [];
}
