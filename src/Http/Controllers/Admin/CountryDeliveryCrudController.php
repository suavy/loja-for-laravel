<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Suavy\LojaForLaravel\Models\Country;

class CountryDeliveryCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(Country::class);
        $this->crud->setRoute('admin/country-delivery');
        $this->crud->setEntityNameStrings('pays de livraison', 'pays de livraisons');

        $this->crud->addButtonFromView('line', 'toggleCountry', 'toggle-country', 'beginning');
    }

    protected function setupListOperation()
    {
        $this->crud->removeButton('delete');
        $this->crud->removeButton('show');
        $this->crud->removeButton('update');
        $this->crud->orderBy('delivery');

        $this->crud->column('id')->label('#');
        $this->crud->column('name')->label('Nom');
        $this->crud->column('delivery')->type('check')->label('Livraison Disponible ?');
    }

    public function toggleCountry($id)
    {
        $country = Country::query()->findOrFail($id);
        $country->delivery = ! $country->delivery;
        $country->save();

        return redirect()->back();
    }

    protected function setupCreateOperation()
    {
        $this->crud->field('disabled')
            ->type('checkbox')
            ->label('Autoriser la livraison');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
