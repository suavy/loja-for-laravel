<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Suavy\LojaForLaravel\Models\Collection;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = loja_collections();

        return view('loja::collection.index', compact('collections'));
    }

    public function show(Collection $collection)
    {
        return view('loja::collection.show', compact('collection'));
    }
}
