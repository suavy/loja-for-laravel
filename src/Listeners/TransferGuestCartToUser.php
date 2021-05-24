<?php

namespace Suavy\LojaForLaravel\Listeners;

class TransferGuestCartToUser
{
    public function handle($event)
    {
        $userCart = \Cart::session($event->user->id);
        //$userCartItems = $userCart->getContent()->toArray();


        $guestCart = session('guest_cart.data');

        if(is_null($guestCart))
            return false;

        $guestCartItems = $guestCart->toArray();

        // my app does not require quantities so I can just add new items as cart lines regardless of
        // duplicates. If your app needs to merge in duplicate product quantities, you can just make
        // the ID of the existing items you are adding the same as the matching items in the user's cart.
        // This library will automatically add in the relative quantity.
        // Or just wipe the user's cart and replace it entirely.
        /*
        if ($userCart->getContent()->isNotEmpty()) {
            $maxUserCartId = max(array_column($userCartItems, 'id'));

            // user cart has items, make sure the guest cart item ID's don't clash
            $guestCartItems = array_map(function ($item) use (&$maxUserCartId) {
                return array_merge($item, ['id' => ++$maxUserCartId]);
            }, $guestCartItems);
        }

        if ($guestCart->isNotEmpty()) $userCart->add($guestCartItems);

        */

        $userCart->add($guestCartItems);

        /*
        $dbCart = \Cart::find(session('guest_cart.session') . '_cart_items'); // <- using DB storage for cart

        if ($dbCart) $dbCart->delete(); // or clear from session
        */
    }
}
