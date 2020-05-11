<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaAttributeValuesTable extends Migration
{
    public function up()
    {
        Schema::create('loja_attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('loja_attributes');
            $table->string('value')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loja_attribute_values');
    }
}
