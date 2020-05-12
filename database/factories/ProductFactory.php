<?php

namespace Suavy\LojaForLaravel\Database\Factories;

use Suavy\LojaForLaravel\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->words(3, true),
        'slug' => str_slug($name),
        'description' => $faker->paragraph,
        'tax_id' => 1
    ];
});
