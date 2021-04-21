<?php

namespace Suavy\LojaForLaravel\Http\Livewire;

use Livewire\Component;

class CartCounter extends Component
{
    public $counter;

    public function render()
    {
        $this->users = \Cart::session(session()->getId())->getTotalQuantity();

        return view('loja::livewire.cart-counter');
    }
}
