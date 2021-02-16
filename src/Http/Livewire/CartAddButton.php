<?php

namespace Suavy\LojaForLaravel\Http\Livewire;

use Livewire\Component;
use Suavy\LojaForLaravel\Models\Product;

class CartAddButton extends Component
{
    public $quantityToAdd;
    public $product;

    public function mount(Product $product)
    {
        $this->quantityToAdd = 0;
        $this->product = $product;
    }

    public function render()
    {
        return view('loja::livewire.cart-add-button');
    }

    public function add()
    {
        $this->quantityToAdd++;
    }

    public function less()
    {
        $this->quantityToAdd--;
    }
}
