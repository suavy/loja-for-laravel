<?php

namespace Suavy\LojaForLaravel\Traits\Products;

use Illuminate\Support\Str;

trait HasCart
{

    public function cartAdd($quantity)
    {
        \Cart::session(session()->getId())->add(array(
            'id' => $this->id, // inique row ID
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $quantity,
            'associatedModel' => $this
        ));
    }

    public function cartRemove(){
        \Cart::session(session()->getId())->remove($this->id);
    }

    public function cartAddQuantity(){
        \Cart::session(session()->getId())->update($this->id, array(
            'quantity' => +1
        ));
    }

    public function cartLessQuantity(){
        \Cart::session(session()->getId())->update($this->id, array(
            'quantity' => -1
        ));
    }

}
