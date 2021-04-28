<?php

namespace Suavy\LojaForLaravel\Http\Livewire;

use Livewire\Component;

class CartCounter extends Component
{
    public $counter;

    public $listeners = ['updateQuantityProduct' => 'updateQuantityProduct'];

    public function render()
    {
        $this->counter = \Cart::session(session()->getId())->getTotalQuantity();

        return view('loja::livewire.cart-counter');
    }

    public function updateQuantityProduct()
    {
        $this->counter = \Cart::session(session()->getId())->getTotalQuantity();
    }
}
