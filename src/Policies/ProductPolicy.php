<?php

namespace Suavy\LojaForLaravel\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    //this is an example
    public function show($product)
    {
        //return $product->hasQuantity();
        return true;
    }
}
