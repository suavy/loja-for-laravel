<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->foreignId('tax_id');
            $table->foreign('tax_id')->references('id')->on('taxes');
            $table->decimal('price', 13, 2)->nullable();
            $table->unsignedBigInteger('stock')->default(0);
            $table->boolean('enabled')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
