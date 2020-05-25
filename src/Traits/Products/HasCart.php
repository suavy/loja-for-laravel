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

    public function cartUpdateQuantityWithTotalQuantityProduct(){
        $fakeQuantity = 2;
        \Cart::session(session()->getId())->update($this->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $fakeQuantity
            ),
        ));
    }

    public function hasEnoughQuantityAvailable($quantityAdd){
        $fakeTotalQuantity = 5; //todo replace fake totalQuantity
        return $fakeTotalQuantity - $this->cartQuantity() + $quantityAdd > 0;
    }

    public function hasEnoughQuantityMaximum($quantityAdd){
        $quantityMaximum = 10;
        return $quantityMaximum - $this->cartQuantity() + $quantityAdd > 0;
    }

    public function cartQuantity(){
        $item = \Cart::session(session()->getId())->get($this->id);
        return is_null($item) ? 0 : $item->quantity;
    }
}
