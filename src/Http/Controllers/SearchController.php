<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        return view('loja::search.index');
    }
}
