<?php

namespace Suavy\LojaForLaravel\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
