<?php

use Suavy\LojaForLaravel\Models\Category;
use Suavy\LojaForLaravel\Models\Collection;
use Suavy\LojaForLaravel\Models\Product;

function loja_products()
{
    return Product::all();
}

function loja_collections()
{
    return Collection::query()->orderBy('lft')->enabled()->get();
}

function loja_collections_home()
{
    return Collection::getForHome();
}

function loja_categories()
{
    return Category::all();
}
