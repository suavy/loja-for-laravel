<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Suavy\LojaForLaravel\Models\AttributeSet;
use Suavy\LojaForLaravel\Models\Product;

class ProductCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        $this->crud->setModel(Product::class);
        $this->crud->setRoute('admin/product');
        $this->crud->setEntityNameStrings('product', 'products');
    }

    protected function setupListOperation()
    {
        $this->crud->addButtonFromModelFunction('line', 'redirect-to-show', 'redirectToProductPage', 'beginning');
        $this->crud->column('id')->label('#');
        $this->crud->column('name')->label('Nom');
        $this->crud->column('slug')->label('Slug');
        /*
        $table->decimal('price', 13, 2)->nullable();
        $table->unsignedBigInteger('stock')->default(0);
        $table->boolean('enabled')->default(false);
        $table->timestamps();
        */
    }

    protected function setupCreateOperation()
    {
        $this->crud->field('name')->type('text')->label('Nom');
        $this->crud->field('description')->type('textarea')->label('Description');
        $this->crud->field('content')->type('textarea')->label('Content');
        $this->crud->field('price')->type('number')->label('Prix')->attributes(['step'=>'any'])->suffix('€')->wrapper(['class'=>'form-group col-md-6']);
        $this->crud->field('stock')->type('number')->label('Stock')->wrapper(['class'=>'form-group col-md-6']);

        $this->crud->field('category_id')->type('select2')->label('Catégorie')->entity('category')->attribute('name')->options(function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        });
        $this->crud->field('collection_id')->type('select2')->label('Collection')->entity('collection')->attribute('name')->options(function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        });
        $this->crud->field('attribute_set_id')->type('select2')->model(AttributeSet::class)->label("Set d'attributes")->attribute('name')->model(AttributeSet::class)->options(function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        });
        $this->crud->field('tax_id')->type('select2')->label('Taxe')->entity('tax')->attribute('name')->options(function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        });
        $this->crud->field('images')->label('Images')->type('browse_multiple')->sortable(true)->mimeTypes('images');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
