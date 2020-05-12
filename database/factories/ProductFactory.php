<?php

namespace Suavy\LojaForLaravel\Database\Factories;

use Faker\Generator as Faker;
use Suavy\LojaForLaravel\Models\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->words(3, true),
        'slug' => str_slug($name),
        'description' => $faker->paragraph,
        'tax_id' => 1,
    ];
});
