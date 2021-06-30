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

    public function setup()
    {
        $this->crud->setModel(Order::class);
        $this->crud->setRoute('admin/order');
        $this->crud->setEntityNameStrings('Commande', 'Commandes');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id')->label('#');
        $this->crud->column('user_id')->label('user');
        $this->crud->column('order_status_id')->label('status');
    }

    protected function setupCreateOperation()
    {
        $this->crud->field('user_id')->label('Utilisateur')->attributes(['disabled' => 'disabled']);
        $this->crud->field('order_status_id')->type('select2')->label('Status')->entity('orderStatus')->model(OrderStatus::class)->attribute('name');
        $this->crud->field('stripe_id')->label('stripe_id')->attributes(['disabled' => 'disabled']);;
        $this->crud->field('amount')->label('amount')->attributes(['disabled' => 'disabled']);
        $this->crud->field('amount_received')->label('amount_received')->attributes(['disabled' => 'disabled']);
        $this->crud->field('user_comment')->type('textarea')->label('user_comment');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
