<?php

namespace Suavy\LojaForLaravel\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $cartHasItems;
    public $cartItems;

    public function mount(): void
    {
        if (\Cart::session(session()->getId())->isEmpty()) {
            $this->cartHasItems = false;
        } else {
            $this->cartHasItems = true;
            $this->cartItems = \Cart::session(session()->getId())->getContent();
        }
    }

    public function render()
    {
        return view('loja::livewire.cart');
    }

    public function emptyCart()
    {
        \Cart::session(session()->getId())->clear();
        $this->cartItems = null;
    }

    public function removeFromCart($productId): void
    {
        CartFacade::remove($productId);
        $this->cart = CartFacade::get();
    }

    public function checkout(): void
    {
        CartFacade::clear();
        $this->cart = CartFacade::get();
    }
}
