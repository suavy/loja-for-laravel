<?php

namespace Suavy\LojaForLaravel\Database\Factories;

use Faker\Generator as Faker;
use Suavy\LojaForLaravel\Models\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->words(3, true),
        'slug' => str_slug($name),
        'category_id' => $faker->numberBetween(1, 20),
        'collection_id' => $faker->numberBetween(1, 20),
        'description' => $faker->paragraph,
        'tax_id' => 1,
        'price' => $faker->randomFloat(2, 5, 500),
        'stock' => $faker->numberBetween(0, 5),
        'enabled' => $faker->boolean(90),
    ];
});
