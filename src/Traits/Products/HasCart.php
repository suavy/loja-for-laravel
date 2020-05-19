<?php

namespace Suavy\LojaForLaravel\Traits\Products;

trait HasCart
{
    public function cartAdd($quantity)
    {
        \Cart::session(session()->getId())->add([
            'id' => $this->id, // inique row ID
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $quantity,
            'associatedModel' => $this,
        ]);
    }

    public function cartRemove()
    {
        \Cart::session(session()->getId())->remove($this->id);
    }

    public function cartAddQuantity()
    {
        \Cart::session(session()->getId())->update($this->id, [
            'quantity' => +1,
        ]);
    }

    public function cartLessQuantity()
    {
        \Cart::session(session()->getId())->update($this->id, [
            'quantity' => -1,
        ]);
    }
}
