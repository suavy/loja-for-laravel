<?php

namespace Suavy\LojaForLaravel\Http\Livewire;

use Livewire\Component;
use Suavy\LojaForLaravel\Models\Product;

class CartAddButton extends Component
{
    public $attributes = [];
    public $product;
    public $productIsAddedToCart;
    public $quantity;

    public function mount(Product $product)
    {
        $this->productIsAddedToCart = false;
        $this->quantity = 1;
        $this->product = $product;
    }

    public function render()
    {
        return view('loja::livewire.cart-add-button');
    }

    public function addQuantity()
    {
        $this->quantity++;
    }

    public function lessQuantity()
    {
        $this->quantity--;
    }

    public function addToCart()
    {

        if (! $this->product->hasEnoughQuantityAvailable($this->quantity)) {
            //la quantitée demandé n'est pas disponible
        }

        if (! $this->product->hasEnoughQuantityMaximum($this->quantity)) {
            //Désolé, vous avez ajouté la quantitée maximum pour ce produit
        }

        $attributeValues = [$this->attributes]; //TODO improve front
        $this->product->cartAdd($this->quantity, $attributeValues);

        $this->productIsAddedToCart = true;

        //reset quantity
        $this->quantity = 0;
    }
}
