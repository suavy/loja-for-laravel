<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Suavy\LojaForLaravel\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return view('loja::category.show', compact('category'));
    }
}
