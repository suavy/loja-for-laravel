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

    }

    protected function setupListOperation()
    {
        $this->crud->removeButton('delete');
        $this->crud->removeButton('show');

        $this->crud->column('id')->label('#');
        $this->crud->column('name')->label('Nom');
        $this->crud->column('delivery')->type('check')->label('Livraison Disponible ?');
        $this->crud->column('readable_price')->label('Prix');

        $this->crud->addClause('orderBy', 'delivery', 'desc');

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
        $this->crud->field('delivery')
            ->type('checkbox')
            ->label('Autoriser la livraison');

        $this->crud->field('backoffice_price')
            ->type('number')
            ->label('Prix de la livraison')
            ->hint('Mettre 0 ou laisser vide pour une livraison gratuite')
            ->attributes(['step'=>'0.01'])
            ->suffix('€')
            ->wrapper(['class'=>'form-group col-md-6']);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
