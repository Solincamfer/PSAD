<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSucursales extends Migration
{
    public $timestamps=false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
           $table->increments('id');
            $table->string('razon_s',100);
            $table->string('nombre_c',100);

            $table->integer('rif_id')->unsigned();
            $table->integer('tipo_id')->unsigned();
            $table->integer('direccion_id')->unsigned();
            $table->integer('direccion__id')->unsigned();
            $table->integer('contacto_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->integer('categoria_id')->unsigned();

            $table->foreign('rif_id')->references('id')->on('rifs')->onDelate('cascade');
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelate('cascade');
            $table->foreign('direccion_id')->references('id')->on('direcciones')->onDelate('cascade');
            $table->foreign('direccion__id')->references('id')->on('direcciones')->onDelate('cascade');
            $table->foreign('contacto_id')->references('id')->on('contactos')->onDelate('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelate('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelate('cascade');

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
