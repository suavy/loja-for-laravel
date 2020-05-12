<?php

namespace Suavy\LojaForLaravel\Database\Factories;

use Suavy\LojaForLaravel\Models\Tax;
use Faker\Generator as Faker;

$factory->define(Tax::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->words(1, true),
        'value' => 20.00,
    ];
});
