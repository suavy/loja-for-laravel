<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Suavy\LojaForLaravel\Models\Collection;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::query()->get();

        return view('loja::collection.index', compact('collections'));
    }

    public function show(Collection $collection)
    {
        $collection = Collection::query()->first(); // todo fix
        return view('loja::collection.show', compact('collection'));
    }
}
