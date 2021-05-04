<?php

namespace Suavy\LojaForLaravel\Listeners;

class PrepareCartTransfer
{
    public function handle()
    {
        if (\Auth::guest()) {
            session()->flash('guest_cart', [
                'session' => session()->getId(),
                'data' => \Cart::session(session()->getId())->getContent(), // J'ai une fonction global cart () dans mon application qui définit la session correcte
            ]);
        }
    }
}
