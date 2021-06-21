<?php

namespace Suavy\LojaForLaravel\Http\Livewire;

use Livewire\Component;
use Suavy\LojaForLaravel\Models\Country;

class Address extends Component
{
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
        $this->optionsCountries = Country::query()->where('cca2', 'FR')->get()->pluck('name', 'id')->toArray();

        if (auth()->user()->address() !== null) {
            $this->addressFirstname = auth()->user()->address()->firstname;
            $this->addressLastname = auth()->user()->address()->lastname;
            $this->addressPhone = auth()->user()->address()->phone;
            $this->addressStreet = auth()->user()->address()->street;
            $this->addressCity = auth()->user()->address()->city;
            $this->addressZipCode = auth()->user()->address()->zip_code;
            $this->addressOther = auth()->user()->address()->other;
            $this->addressCountry = auth()->user()->address()->country->id;
        } else {
            $this->addressFirstname = auth()->user()->firstname;
            $this->addressLastname = auth()->user()->lastname;
        }
    }

    public function render()
    {
        return view('loja::livewire.address');
    }

    public function saveAddress()
    {
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
    }
}
