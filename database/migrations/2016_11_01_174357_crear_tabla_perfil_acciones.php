<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPerfilAcciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles_acciones', function (Blueprint $table) {
            $table->integer('id_perfil')->unsigned();
            $table->integer('id_accion')->unsigned();
            $table->foreign('id_perfil')->references('id')->on('perfiles')->onDelate('cascade');
            $table->foreign('id_accion')->references('id')->on('acciones')->onDelate('cascade');
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
        Schema::dropIfExists('perfiles_acciones');
    }
}
