<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

class AddressController extends Controller
{
    public function index()
    {
        $address = auth()->user()->address();

        return view('loja::user.address', compact('address'));
    }
}
