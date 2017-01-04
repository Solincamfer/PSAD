<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServTiemporesp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned();
            $table->integer('maximo')->unsigned();
            $table->float('precio');
            $table->foreign('plan_id')->references('id')->on('planes')->onDelate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
