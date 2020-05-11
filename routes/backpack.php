<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'Suavy\LojaForLaravel\Http\Controllers\Admin',
], function () { // custom admin routes
    // custom routes
    //Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    // crud routes
    Route::crud('product', 'ProductCrudController');
    Route::crud('taxe', 'TaxeCrudController');
    Route::crud('collection', 'CollectionCrudController');
    Route::crud('category', 'CategoryCrudController');
}); // this should be the absolute last line of this file
