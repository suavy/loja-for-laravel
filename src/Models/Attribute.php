<?php

namespace Suavy\LojaForLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'loja_attributes';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];
}
