<?php

use Illuminate\Support\Facades\Route;
use Suavy\LojaForLaravel\Http\Controllers\Admin\AdminController;

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
    Route::crud('attribute', 'AttributeCrudController');
    Route::crud('attribute-set', 'AttributeSetCrudController');
    Route::crud('attribute-value', 'AttributeValueCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('collection', 'CollectionCrudController');
    Route::crud('country-delivery', 'CountryDeliveryCrudController');
    Route::get('country-delivery/{id}/toggle-country', 'CountryDeliveryCrudController@toggleCountry');
    Route::crud('order', 'OrderCrudController');
    Route::crud('new-order', 'NewOrderCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('tax', 'TaxCrudController');

    Route::post('/verification-de-commmande', [AdminController::class, 'confirmOrder'])->name('admin.confirm.order');
    Route::post('/confirm-order', [AdminController::class, 'confirmOrder'])->name('admin.confirm.order');
}); // this should be the absolute last line of this file
