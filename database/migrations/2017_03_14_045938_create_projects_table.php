<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('caname');
            $table->string('idca');
            $table->string('name');
            $table->date('startDate');
            $table->date('endDate');
            $table->string('description');
            $table->string('Amount'); //Monto total para el proyecto
            $table->string('currentAmount'); //monto actual que se tiene en el proyecto
            $table->string('plusAmount'); //suma el monto cada vez que se actualiza el monto para que no rebase el monto original
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
        Schema::dropIfExists('projects');
    }
}
