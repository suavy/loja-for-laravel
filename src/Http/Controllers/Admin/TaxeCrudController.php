<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Suavy\LojaForLaravel\Models\Taxe;

class TaxeCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(Taxe::class);
        $this->crud->setRoute('admin/taxe');
        $this->crud->setEntityNameStrings('taxe', 'taxes');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id')->label('#');
        $this->crud->column('name')->label('Nom');
        $this->crud->column('value')->label('Valeur');
    }

    protected function setupCreateOperation()
    {

        $this->crud->field('name')->type('text')->label('Nom');
        $this->crud->field('value')->type('number')->label('Valeur')->attributes(['step'=>'any'])->suffix('%');

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
