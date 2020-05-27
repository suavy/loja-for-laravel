<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Suavy\LojaForLaravel\Models\CountryDelivery;

class CountryDeliveryCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(CountryDelivery::class);
        $this->crud->setRoute('admin/country-delivery');
        $this->crud->setEntityNameStrings('pays de livraison', 'pays de livraisons');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id')->label('#');
        $this->crud->column('name')->label('Nom du pays');
        $this->crud->column('cca2')->label('Code cca2');
    }

    protected function setupCreateOperation()
    {
        //todo small bug on edit, current value isnt populate idk why
        $this->crud->field('cca2')
            ->allowsNull(false)
            ->type('select2_from_array')
            ->label('Nom du pays')
            ->options(CountryDelivery::countriesNotSelected());
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

}
