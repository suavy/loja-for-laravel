<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Suavy\LojaForLaravel\Models\Category;

class CategoryCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;
    use ReorderOperation;

    public function setup()
    {
        $this->crud->setModel(Category::class);
        $this->crud->setRoute('admin/category');
        $this->crud->setEntityNameStrings('catégorie', 'catégories');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id')->label('#');
        $this->crud->column('name')->label('Nom');
        $this->crud->column('slug')->label('Slug');
        $this->crud->column('enabled')->type('check')->label('Activé');
    }

    protected function setupCreateOperation()
    {
        $this->crud->field('name')->type('text')->label('Nom');
        $this->crud->field('description')->type('textarea')->label('Description');
        $this->crud->field('enabled')->type('checkbox')->label('Activer');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'name');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 0);
    }
}
