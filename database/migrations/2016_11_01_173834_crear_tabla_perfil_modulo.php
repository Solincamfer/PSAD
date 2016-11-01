<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPerfilModulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles_modulos', function (Blueprint $table) {
            $table->integer('id_perfil')->unsigned();
            $table->integer('id_modulo')->unsigned();
            $table->foreign('id_perfil')->references('id')->on('perfiles')->onDelate('cascade');
            $table->foreign('id_modulo')->references('id')->on('modulos')->onDelate('cascade');
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
        Schema::dropIfExists('perfiles_modulos');
    }
}
