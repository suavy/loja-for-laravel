<?php

namespace Suavy\LojaForLaravel\Database\Factories;

use Faker\Generator as Faker;
use Suavy\LojaForLaravel\Models\Collection;

$factory->define(Collection::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->words(1, true),
        'slug' => str_slug($name),
        'description' => $faker->paragraph,
        'enabled' => $faker->boolean(80),
    ];
});
