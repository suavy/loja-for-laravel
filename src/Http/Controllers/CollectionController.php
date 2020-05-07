<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Suavy\LojaForLaravel\Models\Collection;

class CollectionController extends Controller
{
    public function show(Collection $collection)
    {
        return view('loja::collection.show', compact('collection'));
    }
}
