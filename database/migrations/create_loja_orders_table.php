<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('loja_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('order_status_id');
            $table->foreign('order_status_id')->references('id')->on('loja_order_statuses');
            $table->mediumText('user_comment')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loja_orders');
    }
}
