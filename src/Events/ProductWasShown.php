<?php

namespace Suavy\LojaForLaravel\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Suavy\LojaForLaravel\Models\Product;

class ProductWasShown
{
    use Dispatchable, SerializesModels;

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
