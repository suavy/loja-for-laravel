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
    return Collection::all();
}

function loja_categories()
{
    return Category::all();
}
