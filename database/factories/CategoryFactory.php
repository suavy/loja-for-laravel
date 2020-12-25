<?php

namespace Suavy\LojaForLaravel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Suavy\LojaForLaravel\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $name = $this->faker->words(1, true),
            'slug' => str_slug($name),
            'description' => $this->faker->paragraph,
            'enabled' => $this->faker->boolean(80),
        ];
    }
}
