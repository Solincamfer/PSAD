<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEequipoModelo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamps=false;
    public function up()
    {
        Schema::create('equipo_modelo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tequipo_id')->unsigned();
            $table->integer('emodelo_id')->unsigned();
            $table->foreign('tequipo_id')->references('id')->on('tequipos');
            $table->foreign('emodelo_id')->references('id')->on('emodelos');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo_modelo');
    }
}
