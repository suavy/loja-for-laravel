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

class OrderCrudController extends CrudController
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
        $this->crud->setRoute('admin/order');
        $this->crud->setEntityNameStrings('Commande', 'Commandes');

        $this->crud->setShowView('loja::admin.manager-order');
    }

    protected function setupListOperation()
    {
        //$this->crud->addClause('processed');
        $this->crud->column('id')->label('#');

        $this->crud->column('readable_order_status')->label('Status');

        $this->crud->column('user')
            ->type('relationship')
            ->attribute('firstname')
            ->label('Utilisateur');

        $this->crud->column('readable_price')->label('Prix total');

        $this->crud->column('readable_products')->label('Produits');

        $this->crud->column('created_at')
            ->type('datetime')
            ->format('Y/MM/DD HH:mm')
            ->label('Date');

        $this->crud->column('delivery_tracking')
            ->type('text')
            ->label('N suivi');

        $this->crud->addFilter([
            'name' => 'status',
            'type' => 'select2',
            'label' => 'Status',
        ], function () {
            return OrderStatus::all()->pluck('readable_order_status', 'id')->toArray();
        }, function ($values) {
            $this->crud->addClause('where', 'order_status_id', json_decode($values));
        });

        $this->crud->denyAccess('create');
        $this->crud->denyAccess('update');
        $this->crud->denyAccess('delete');
    }

    protected function setupCreateOperation()
    {
        $this->crud->field('user_id')->label('Utilisateur')->attributes(['disabled' => 'disabled']);
        $this->crud->field('order_status_id')->type('select2')->label('Status')->entity('orderStatus')->model(OrderStatus::class)->attribute('name');
        $this->crud->field('stripe_id')->label('stripe_id')->attributes(['disabled' => 'disabled']);
        $this->crud->field('amount')->label('amount')->attributes(['disabled' => 'disabled']);
        $this->crud->field('amount_received')->label('amount_received')->attributes(['disabled' => 'disabled']);
        $this->crud->field('user_comment')->type('textarea')->label('user_comment');
    }

    protected function setupShowOperation()
    {
        $this->crud->removeButton('update');
        $this->crud->denyAccess('delete');
        $this->crud->addButtonFromView('line', 'validate', 'validate', 'beginning');
    }
}
