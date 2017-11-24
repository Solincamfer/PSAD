<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMarcaModelo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamps=false;
    public function up()
    {
        Schema::create('marca_modelo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emarca_id')->unsigned();
            $table->integer('emodelo_id')->unsigned();
            $table->foreign('emarca_id')->references('id')->on('emarcas');
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
        Schema::dropIfExists('marca_modelo');
    }
}
