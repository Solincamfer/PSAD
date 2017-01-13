<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEquiposMmarca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_marca', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tequipo_id')->unsigned();
            $table->integer('emarca_id')->unsigned();
            $table->foreign('tequipo_id')->references('id')->on('tequipos');
            $table->foreign('emarca_id')->references('id')->on('emarcas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo_marca');
    }
}
