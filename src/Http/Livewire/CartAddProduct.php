<?php

namespace Suavy\LojaForLaravel\Http\Livewire;

use Livewire\Component;
use Suavy\LojaForLaravel\Models\Product;

class CartAddProduct extends Component
{
    public $attributes = [];
    public $product;
    public $productIsAddedToCart;
    public $quantity;

    protected $rules = [
        'quantity' => 'required|min:1',
    ];

    public function mount(Product $product)
    {
        $this->productIsAddedToCart = false;
        $this->quantity = 1;
        $this->product = $product;
    }

    public function render()
    {
        return view('loja::livewire.cart-add-product');
    }

    public function addToCart()
    {
        if ($this->product->hasAttributes()) {
            $this->rules['attributes'] = 'required|array|min:1';
        }

        $this->validate();

        if (! $this->product->hasEnoughQuantityAvailable($this->quantity)) {
            //la quantitée demandé n'est pas disponible
        }

        if (! $this->product->hasEnoughQuantityMaximum($this->quantity)) {
            //Désolé, vous avez ajouté la quantitée maximum pour ce produit
        }

        $this->product->cartAdd($this->quantity, $this->attributes);

        $this->productIsAddedToCart = true;

        //reset quantity
        $this->quantity = 1;

        $this->emit('updateQuantityProduct');
    }
}
