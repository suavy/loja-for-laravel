<?php

namespace Suavy\LojaForLaravel\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Suavy\LojaForLaravel\Models\Order;
use Suavy\LojaForLaravel\Models\OrderStatus;
use Suavy\LojaForLaravel\Models\Product;
use Suavy\LojaForLaravel\Notifications\OrderSent;

class NewOrderCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }

    public function setup()
    {
        $this->crud->setModel(Order::class);
        $this->crud->setRoute('admin/new-order');
        $this->crud->setEntityNameStrings('Commande', 'Commandes');



        $this->crud->setShowView('loja::admin.manager-order');
    }

    protected function setupListOperation()
    {
        $this->crud->addClause('processed');
        $this->crud->column('id')->label('#');
        $this->crud->column('user')
            ->type('relationship')
            ->attribute('firstname')
            ->label('Utilisateur');

        $this->crud->column('readable_products')->label('Produits');

        $this->crud->denyAccess('create');
        $this->crud->denyAccess('update');
        $this->crud->denyAccess('delete');


    }

    protected function setupShowOperation()
    {
        $this->crud->removeButton('update');
        $this->crud->denyAccess('delete');
        $this->crud->addButtonFromView('line', 'validate', 'validate', 'beginning');
    }

}
