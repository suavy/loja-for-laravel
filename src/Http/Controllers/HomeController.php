<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('loja::home.index');
    }
}
