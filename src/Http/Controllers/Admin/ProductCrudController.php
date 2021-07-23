<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Suavy\LojaForLaravel\Models\AttributeSet;
use Suavy\LojaForLaravel\Models\Category;
use Suavy\LojaForLaravel\Models\Collection;
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

        $this->crud->column('readable_price')->label('Prix');

        $this->crud->column('collection')
            ->type('relationship')
            ->attribute('name')
            ->label('Collection');

        $this->crud->column('category')
            ->type('relationship')
            ->attribute('name')
            ->label('Catégorie');

        $this->crud->column('attributeSet')
            ->type('relationship')
            ->attribute('name')
            ->label('Set d\'attribue');

        $this->crud->addFilter([
            'name'  => 'collection',
            'type'  => 'select2_multiple',
            'label' => 'Collections',
        ], function () {
            return Collection::all()->pluck('name', 'id')->toArray();
        }, function ($values) {
            $this->crud->addClause('whereIn', 'collection_id', json_decode($values));
        });

        $this->crud->addFilter([
            'name'  => 'category',
            'type'  => 'select2_multiple',
            'label' => 'Catégories',
        ], function () {
            return Category::all()->pluck('name', 'id')->toArray();
        }, function ($values) {
            $this->crud->addClause('whereIn', 'category_id', json_decode($values));
        });

        $this->crud->addFilter([
            'name'       => 'number',
            'type'       => 'range',
            'label'      => 'Prix',
            'label_from' => 'min',
            'label_to'   => 'max',
        ],
            false,
            function ($value) { // if the filter is active
                $range = json_decode($value);
                if ($range->from) {
                    $min = $range->from * 100;
                    $this->crud->addClause('where', 'price', '>=', $min);
                }
                if ($range->to) {
                    $max = $range->to * 100;
                    $this->crud->addClause('where', 'price', '<=', $max);
                }
            });
    }

    protected function setupCreateOperation()
    {
        $this->crud->field('name')->type('text')->label('Nom');
        $this->crud->field('sub_name')->type('text')->label('Petite description');
        $this->crud->field('description')->type('textarea')->label('Description');
        //$this->crud->field('content')->type('textarea')->label('Content');

        $this->crud->field('backoffice_price')
            ->type('number')
            ->label('Prix')
            ->attributes(['step'=>'0.01'])
            ->suffix('€')
            ->wrapper(['class'=>'form-group col-md-6']);
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
