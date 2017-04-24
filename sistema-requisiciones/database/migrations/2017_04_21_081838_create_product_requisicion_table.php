<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//ESTA TABLA ES INTERMEDIA Y NO ES NECESARIO CREAR UN MODELO PARA ÉSTA, SOLO BASTA CON CREAR LA TABLA EN ORDEN ALFABETICO, ESTA LA HICE PRODUCT - REQUISICION  PRIMERO VA LA P Y LUEGO R

class CreateProductRequisicionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_requisicion', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('requisicion_id');
            $table->foreign('requisicion_id')->references('id')->on('requisicions');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_requisicion');
    }
}
