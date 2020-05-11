<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Suavy\LojaForLaravel\Models\Category;
use Suavy\LojaForLaravel\Models\Collection;

class TaxeCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(Collection::class);
        $this->crud->setRoute('admin/collection');
        $this->crud->setEntityNameStrings('collection', 'collections');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id');
    }

    protected function setupCreateOperation()
    {
        $this->crud->field('slug')->type('text')->label('Slug');
        $this->crud->field('name')->type('text')->label('Nom');
        $this->crud->field('description')->type('textarea')->label('Description');

        $this->crud->field('category_id')->label('Catégorie')->type('select')->entity('category')->model(Category::class)->attribute('name');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
