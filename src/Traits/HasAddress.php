<?php

namespace Suavy\LojaForLaravel\Traits;

use Suavy\LojaForLaravel\Models\Address;

trait HasAddress
{
    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    public function hasAddress()
    {
        return $this->addresses()->exists();
    }

    public function address()
    {
        return $this->addresses()->first();
    }

    public function updateAddress($address)
    {
        $this->hasAddress() ? $this->address()->update($address) : (new Address($address))->user()->associate($this)->save();
    }

}
