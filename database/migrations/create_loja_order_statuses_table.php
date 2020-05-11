<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaOrderStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('loja_order_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('name');
            $table->boolean('notification')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
}
