<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaAttributeAttributeSetTable extends Migration
{
    public function up()
    {
        Schema::create('loja_attribute_attribute_set', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('loja_attributes');
            $table->foreignId('attribute_set_id');
            $table->foreign('attribute_set_id')->references('id')->on('loja_attribute_sets');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loja_attribute_attribute_set');
    }
}
