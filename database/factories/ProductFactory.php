<?php

namespace Suavy\LojaForLaravel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Suavy\LojaForLaravel\Models\Category;
use Suavy\LojaForLaravel\Models\Collection;
use Suavy\LojaForLaravel\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $name = $this->faker->words(3, true),
            'slug' => str_slug($name),
            'description' => $this->faker->paragraph,
            'tax_id' => 1,
            'price' => $this->faker->randomFloat(2, 5, 500),
            'stock' => $this->faker->numberBetween(0, 5),
            'enabled' => $this->faker->boolean(90),
        ];
    }

    public function configure()
    {
        return $this
            ->afterMaking(function (Product $product) {
                $product->category()->associate(
                    Category::query()->inRandomOrder()->first()
                );
                $product->collection()->associate(
                    Collection::query()->inRandomOrder()->first()
                );
            });
    }
}
