<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDirecciones extends Migration
{
    public $timestamps=false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('descripcion',500);

            $table->integer('municipio_id')->unsigned();
            $table->integer('pais_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->integer('estado_id')->unsigned();

            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelate('cascade');
            $table->foreign('pais_id')->references('id')->on('paises')->onDelate('cascade');
            $table->foreign('region_id')->references('id')->on('regiones')->onDelate('cascade');
            $table->foreign('estado_id')->references('id')->on('estados')->onDelate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direcciones');
    }
}
