<?php

namespace Suavy\LojaForLaravel\Http\Livewire;

use Livewire\Component;
use Suavy\LojaForLaravel\Models\Country;

class Cart extends Component
{
    public $cartHasItems;
    public $cartItems;
    public $totalPrice;

    public $addressName;
    public $addressFirstname;
    public $addressLastname;
    public $addressPhone;
    public $addressStreet;
    public $addressCity;
    public $addressZipCode;
    public $addressState;
    public $addressOther;
    public $addressCountry;

    public $optionsCountries;

    public $delivery_price = null;

    public $country;

    public $email;
    public $password;
    public $isLogged = false;

    protected $rules = [
        'addressFirstname' => 'required',
        'addressLastname' => 'required',
        'addressPhone' => 'required',
        'addressStreet' => 'required',
        'addressCity' => 'required',
        'addressZipCode' => 'required',
        'addressCountry' => 'required',
    ];

    public function mount(): void
    {
        if (auth()->check()) {
            $this->optionsCountries = Country::forSelect()->toArray();

            if (auth()->user()->address() !== null) {
                $this->addressFirstname = auth()->user()->address()->firstname;
                $this->addressLastname = auth()->user()->address()->lastname;
                $this->addressPhone = auth()->user()->address()->phone;
                $this->addressStreet = auth()->user()->address()->street;
                $this->addressCity = auth()->user()->address()->city;
                $this->addressZipCode = auth()->user()->address()->zip_code;
                $this->addressOther = auth()->user()->address()->other;
                $this->addressCountry = auth()->user()->address()->country->id;
                $this->country = auth()->user()->address()->country;
                $this->delivery_price = $this->country->delivery_price;
            } else {
                $this->addressFirstname = auth()->user()->firstname;
                $this->addressLastname = auth()->user()->lastname;
            }
        }

        //$this->updateItems();
    }

    public function render()
    {
        $this->updateItems();

        return view('loja::livewire.cart');
    }

    public function lessQuantity($id)
    {
        \Cart::session(session()->getId())->update($id, [
            'quantity' => -1,
        ]);
        //$this->updateItems();
    }

    public function addQuantity($id)
    {
        \Cart::session(session()->getId())->update($id, [
            'quantity' => +1,
        ]);
        //$this->updateItems();
    }

    public function removeProduct($id)
    {
        \Cart::session(session()->getId())->remove($id);
        //$this->updateItems();
    }

    public function updatedAddressCountry($country)
    {
        $country = Country::query()->find($country);
        $this->country = $country;
        $this->delivery_price = $country->delivery_price;

        $this->totalPrice = \Cart::getTotal() + $this->country->delivery_price;
    }

    public function updateItems()
    {
        if (\Cart::session(session()->getId())->isEmpty()) {
            $this->cartHasItems = false;
            $this->cartItems = [];
            $this->totalPrice = 0;
            $this->subTotalPrice = 0;
        } else {
            $this->cartHasItems = true;
            //$this->cartItems = \Cart::session(session()->getId())->getContent();
            $this->cartItems = \Cart::getContent();
            $this->totalPrice = \Cart::getTotal();
            $this->subTotalPrice = \Cart::getTotal();
            if (! is_null($this->delivery_price)) {
                $this->totalPrice = $this->totalPrice + $this->delivery_price;
            }
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

    public function updated($propertyName)
    {
        //$this->updateItems();

        $this->validateOnly($propertyName);
    }

    public function saveAddress()
    {
        //$this->updateItems();

        $this->validate();

        auth()->user()->updateAddress([
            'name' => 'Adresse par défault',
            'firstname' => $this->addressFirstname,
            'lastname' => $this->addressLastname,
            'phone' => $this->addressPhone,
            'street' => $this->addressStreet,
            'city' => $this->addressCity,
            'zip_code' => $this->addressZipCode,
            'other' => $this->addressOther,
            'country_id' => $this->addressCountry,
        ]);

        $this->dispatchBrowserEvent('checkout');
    }
}
