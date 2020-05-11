<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaOrderProductTable extends Migration
{
    public function up()
    {
        Schema::create('loja_order_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id');
            $table->foreign('product_id')->references('id')->on('loja_products');
            $table->foreignId('order_id');
            $table->foreign('order_id')->references('id')->on('loja_orders');
            $table->unsignedInteger('quantity');
            $table->decimal('price', 13, 2)->nullable();
            $table->decimal('price_with_tax', 13, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}
