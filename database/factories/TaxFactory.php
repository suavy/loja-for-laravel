<?php

namespace Suavy\LojaForLaravel\Database\Factories;

use Faker\Generator as Faker;
use Suavy\LojaForLaravel\Models\Tax;

$factory->define(Tax::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->words(1, true),
        'value' => 20.00,
    ];
});
