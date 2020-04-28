<?php

namespace Suavy\LojaForLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Suavy\LojaForLaravel\Skeleton\SkeletonClass
 */
class LojaForLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'loja-for-laravel';
    }
}
