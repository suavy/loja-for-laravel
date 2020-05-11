<?php

namespace Suavy\LojaForLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'loja_attribute_values';
    // Disable Laravel's mass assignment protection
    protected $guarded = [];
}
