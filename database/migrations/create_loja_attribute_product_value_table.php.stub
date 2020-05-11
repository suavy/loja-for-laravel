<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaAttributeProductValueTable extends Migration
{
    public function up()
    {
        Schema::create('loja_attribute_product_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('loja_attributes');
            $table->foreignId('product_id');
            $table->foreign('product_id')->references('id')->on('loja_products');
            $table->string('value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loja_attribute_product_value');
    }
}
