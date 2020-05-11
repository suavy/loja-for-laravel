<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Suavy\LojaForLaravel\Models\Category;
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
        $this->crud->column('id');

        /*
        $table->bigIncrements('id');
        $table->string('slug');
        $table->string('name');
        $table->longText('description')->nullable();
        $table->foreignId('category_id')->nullable();
        $table->foreign('category_id')->references('id')->on('loja_categories');
        $table->foreignId('collection_id')->nullable();
        $table->foreign('collection_id')->references('id')->on('loja_collections');
        $table->foreignId('tax_id');
        $table->foreign('tax_id')->references('id')->on('loja_taxes');
        $table->decimal('price', 13, 2)->nullable();
        $table->unsignedBigInteger('stock')->default(0);
        $table->boolean('enabled')->default(false);
        $table->timestamps();
        */
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
