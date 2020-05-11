<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Illuminate\Support\Str;
use Suavy\LojaForLaravel\Models\Category;

class CategoryCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;
    use CreateOperation { store as traitStore; }
    use UpdateOperation { update as traitUpdate; }

    public function setup()
    {
        $this->crud->setModel(Category::class);
        $this->crud->setRoute('admin/category');
        $this->crud->setEntityNameStrings('catégorie', 'catégories');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id');
        $this->crud->column('name');
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

    protected function store()
    {
        $this->crud->getRequest()->request->add(['slug' => Str::slug($this->crud->getRequest()->get('name'))]);
        $response = $this->traitStore();

        return $response;
    }

    public function update()
    {
        $this->crud->getRequest()->request->add(['slug' => Str::slug($this->crud->getRequest()->get('name'))]);
        $response = $this->traitUpdate();

        return $response;
    }
}
