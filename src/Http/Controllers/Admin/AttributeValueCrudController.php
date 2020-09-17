<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Suavy\LojaForLaravel\Models\AttributeValue;

class AttributeValueCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;
    use ReorderOperation;

    public function setup()
    {
        $this->crud->setModel(AttributeValue::class);
        $this->crud->setRoute('admin/attribute-value');
        $this->crud->setEntityNameStrings('valeur d\'attributs', 'valeurs d\'attributs');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id')->label('#');
        $this->crud->column('attribute.name')->label('Attribut');
        $this->crud->column('value')->label('Valeur');
    }

    protected function setupCreateOperation()
    {
        $this->crud->field('attribute_id')->type('select2')->label('Attribut')->entity('attribute')->attribute('name')->options(function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        });
        $this->crud->field('value')->type('text')->label('Valeur');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'name');
        $this->crud->set('reorder.label', 'type');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 0);
    }
}
