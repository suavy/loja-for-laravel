<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaProductsTable extends Migration
{
    public function up()
    {
        Schema::create('loja_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->foreignId('categoriy_id')->nullable();
            $table->foreign('categoriy_id')->references('id')->on('loja_categories');
            $table->foreignId('collection_id')->nullable();
            $table->foreign('collection_id')->references('id')->on('loja_collections');
            $table->foreignId('tax_id');
            $table->foreign('tax_id')->references('id')->on('loja_taxes');
            $table->decimal('price', 13, 2)->nullable();
            $table->unsignedBigInteger('stock')->default(0);
            $table->boolean('enabled')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loja_products');
    }
}
