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
    }

    protected function setupListOperation()
    {
        $this->crud->addClause('processed');
        $this->crud->column('id')->label('#');
        $this->crud->column('user')
            ->type('relationship')
            ->attribute('firstname')
            ->label('Utilisateur');

        $this->crud->column('orderStatus')
            ->type('relationship')
            ->attribute('name')
            ->label('status');

        $this->crud->denyAccess('create');
        $this->crud->removeButton('update');
        $this->crud->denyAccess('delete');
    }

    protected function setupShowOperation()
    {
        $this->crud->removeButton('update');
        $this->crud->denyAccess('delete');
        $this->crud->addButtonFromView('line', 'validate', 'validate', 'beginning');

        $this->crud->column('products')
            ->type('relationship')
            ->attribute('name')
            ->entity('products')
            ->model(Product::class)
            ->label('Produits');
    }

    protected function setupUpdateOperation()
    {
        $this->crud->field('delivery_tracking')->type('text')->label('Lien de suivis de livraison');
    }

    public function update()
    {
        // do something before validation, before save, before everything; for example:
        // $this->crud->addField(['type' => 'hidden', 'name' => 'author_id']);
        // $this->crud->removeField('password_confirmation');

        // Note: By default Backpack ONLY saves the inputs that were added on page using Backpack fields.
        // This is done by stripping the request of all inputs that do NOT match Backpack fields for this
        // particular operation. This is an added security layer, to protect your database from malicious
        // users who could theoretically add inputs using DeveloperTools or JavaScript. If you're not properly
        // using $guarded or $fillable on your model, malicious inputs could get you into trouble.

        // However, if you know you have proper $guarded or $fillable on your model, and you want to manipulate
        // the request directly to add or remove request parameters, you can also do that.
        // We have a config value you can set, either inside your operation in `config/backpack/crud.php` if
        // you want it to apply to all CRUDs, or inside a particular CrudController:
        // $this->crud->setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);
        // The above will make Backpack store all inputs EXCEPT for the ones it uses for various features.
        // So you can manipulate the request and add any request variable you'd like.
        // $this->crud->getRequest()->request->add(['author_id'=> backpack_user()->id]);
        // $this->crud->getRequest()->request->remove('password_confirmation');

        // $this->crud->getRequest()->request->remove('password_confirmation');

        $orderStatusSent = OrderStatus::query()->sent()->first();

        $this->crud->getRequest()->request->add(['order_status_id'=> $orderStatusSent->id]);
        $response = $this->traitUpdate();
        // do something after save

        $this->crud->getCurrentEntry()->user->notify(new OrderSent($this->crud->getCurrentEntry()));

        return $response;
    }
}
