<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

class SearchController extends Controller
{
    public function index()
    {
        return view('loja::search.index');
    }
}
