<?php

namespace Suavy\LojaForLaravel\Tests;

use Orchestra\Testbench\TestCase;
use Suavy\LojaForLaravel\LojaForLaravelServiceProvider;

class ExampleTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [LojaForLaravelServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
