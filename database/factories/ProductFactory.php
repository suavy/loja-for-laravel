<?php

namespace Suavy\LojaForLaravel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Suavy\LojaForLaravel\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $name = $this->faker->words(3, true),
            'slug' => str_slug($name),
            'category_id' => $this->faker->numberBetween(1, 20),
            'collection_id' => $this->faker->numberBetween(1, 20),
            'description' => $this->faker->paragraph,
            'tax_id' => 1,
            'price' => $this->faker->randomFloat(2, 5, 500),
            'stock' => $this->faker->numberBetween(0, 5),
            'enabled' => $this->faker->boolean(90),
        ];
    }
}
