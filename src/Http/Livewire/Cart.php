<?php

namespace Suavy\LojaForLaravel\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $cartHasItems;
    public $cartItems;
    public $totalPrice;

    public function mount(): void
    {
        $this->updateItems();
    }

    public function render()
    {
        return view('loja::livewire.cart');
    }

    public function lessQuantity($id)
    {
        \Cart::session(session()->getId())->update($id, [
            'quantity' => -1,
        ]);
        $this->updateItems();
    }

    public function addQuantity($id)
    {
        \Cart::session(session()->getId())->update($id, [
            'quantity' => +1,
        ]);
        $this->updateItems();
    }

    public function removeProduct($id)
    {
        \Cart::session(session()->getId())->remove($id);
        $this->updateItems();
    }

    public function updateItems()
    {
        if (\Cart::session(session()->getId())->isEmpty()) {
            $this->cartHasItems = false;
            $this->cartItems = [];
            $this->totalPrice = 0;
        } else {
            $this->cartHasItems = true;
            $this->cartItems = \Cart::session(session()->getId())->getContent();
            $this->totalPrice = \Cart::getTotal();
        }

        $this->emit('updateQuantityProduct');
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
