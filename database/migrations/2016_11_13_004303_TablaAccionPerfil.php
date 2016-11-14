<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAccionPerfil extends Migration
{
    public $timestamps=false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accion_perfil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('perfil_id')->unsigned();
            $table->integer('accion_id')->unsigned();
            $table->foreign('perfil_id')->references('id')->on('perfiles');
            $table->foreign('accion_id')->references('id')->on('acciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accion_perfil');
    }
}
