<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        dd("ok");
        return view('loja::home.index');
    }
}
