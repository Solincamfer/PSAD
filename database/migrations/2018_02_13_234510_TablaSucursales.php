<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaSucursales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razonSocial',100);
            $table->string('nombreComercial',100);
            $table->integer('status')->default(1);
            $table->integer('rif_id')->unsigned();
            $table->integer('direccionFiscal_id')->unsigned();
            $table->integer('direccionComercial_id')->unsigned();
            $table->integer('correo_id')->unsigned();
            $table->integer('tipoContribuyente_id')->unsigned();
            $table->integer('categoria_id')->unsigned();

            $table->foreign('rif_id')->references('id')->on('rifs');
            $table->foreign('direccionFiscal_id')->references('id')->on('direcciones');
            $table->foreign('direccionComercial_id')->references('id')->on('direcciones');
            $table->foreign('correo_id')->references('id')->on('correos');
            $table->foreign('tipoContribuyente_id')->references('id')->on('tipos');
            $table->foreign('categoria_id')->references('id')->on('categorias');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursales');
    }
}
