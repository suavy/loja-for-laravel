<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaTaxesTable extends Migration
{
    public function up()
    {
        Schema::create('loja_taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('value', 13, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('taxes');
    }
}
