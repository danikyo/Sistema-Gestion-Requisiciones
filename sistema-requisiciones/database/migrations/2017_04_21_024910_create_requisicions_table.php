<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('area');
            $table->string('observations');
            $table->integer('secretario')->default(0);
            $table->integer('planeacion')->default(0);
            $table->integer('finanzas')->default(0);
            $table->integer('cancel')->default(0); // cuenta los cancelados
            $table->integer('status')->default(1); //| 0 - CANCELADO 1 - PENDIENTE 2 - EJERCIDO

            $table->integer('project_id');
            $table->foreign('project_id')->references('id')->on('projects');

            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('resource_id');
            $table->foreign('resource_id')->references('id')->on('resources');

            $table->integer('activity_id');
            $table->foreign('activity_id')->references('id')->on('activities');

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
        Schema::dropIfExists('requisicions');
    }
}
