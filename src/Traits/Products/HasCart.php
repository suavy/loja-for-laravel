<?php

namespace Suavy\LojaForLaravel\Traits\Products;

use Suavy\LojaForLaravel\Models\AttributeValue;

trait HasCart
{
    private function getUniqueId($attributeValues = [])
    {
        $uniqueId = $this->id;
        if (count($attributeValues)) {
            $attributeValues = collect($attributeValues);
            $attributeValues = $attributeValues->implode('-');
            $uniqueId .= '-'.$attributeValues;
        }

        return $uniqueId;
    }

    public function cartAdd($quantity, $attributeValues = [])
    {
        $cartDatas = [
            'id' => $this->getUniqueId($attributeValues), // inique row ID
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $quantity,
            'associatedModel' => $this,
        ];
        if (count($attributeValues)) {
            $cartDatas['attributes'] = AttributeValue::query()->with('attribute')->whereIn('id', $attributeValues)->get()->pluck('readable', 'id');
        }

        \Cart::session(session()->getId())->add($cartDatas);
    }

    public function cartRemove()
    {
        \Cart::session(session()->getId())->remove($this->id);
    }

    public function cartAddQuantity()
    {
        \Cart::session(session()->getId())->update($this->id, [
            'quantity' => +1,
        ]);
    }

    public function cartLessQuantity()
    {
        \Cart::session(session()->getId())->update($this->id, [
            'quantity' => -1,
        ]);
    }

    public function cartUpdateQuantityWithTotalQuantityProduct()
    {
        $fakeQuantity = 2;
        \Cart::session(session()->getId())->update($this->id, [
            'quantity' => [
                'relative' => false,
                'value' => $fakeQuantity,
            ],
        ]);
    }

    public function hasEnoughQuantityAvailable($quantityAdd)
    {
        return true; //todo pour l'instant on ne gère pas la qtt
        $fakeTotalQuantity = 5; //todo replace fake totalQuantity

        return $fakeTotalQuantity - $this->cartQuantity() + $quantityAdd > 0;
    }

    public function hasEnoughQuantityMaximum($quantityAdd)
    {
        return true; //todo pour l'instant on ne gère pas la qtt
        $quantityMaximum = 10;

        return $quantityMaximum - $this->cartQuantity() + $quantityAdd > 0;
    }

    public function cartQuantity()
    {
        $item = \Cart::session(session()->getId())->get($this->id);

        return is_null($item) ? 0 : $item->quantity;
    }
}
