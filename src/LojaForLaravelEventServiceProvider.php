<?php

namespace Suavy\LojaForLaravel;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Suavy\LojaForLaravel\Listeners\PrepareCartTransfer;
use Suavy\LojaForLaravel\Listeners\TransferGuestCartToUser;

class LojaForLaravelEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \Illuminate\Auth\Events\Attempting::class => [
            PrepareCartTransfer::class,
        ],
        \Illuminate\Auth\Events\Login::class => [
            TransferGuestCartToUser::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
