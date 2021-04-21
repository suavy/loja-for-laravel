<?php

namespace Suavy\LojaForLaravel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Suavy\LojaForLaravel\Models\Collection;

class CollectionFactory extends Factory
{
    protected $model = Collection::class;

    public function definition()
    {
        return [
            'name' => $name = "TEST AB",
            'slug' => str_slug($name),
            'description' => $this->faker->paragraph,
            'enabled' => $this->faker->boolean(80),
        ];
    }
}
