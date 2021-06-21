<?php

namespace Suavy\LojaForLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Suavy\LojaForLaravel\Models\Product;

class AddressController extends Controller
{
    public function index()
    {
        $address = auth()->user()->address();
        return view('loja::user.address',compact('address'));
    }
}
