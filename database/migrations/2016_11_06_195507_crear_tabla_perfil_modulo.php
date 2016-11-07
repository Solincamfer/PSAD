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
        Schema::create('modulo_perfil', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('perfil_id')->unsigned();
            $table->integer('modulo_id')->unsigned();
            $table->foreign('perfil_id')->references('id')->on('perfiles');
            $table->foreign('modulo_id')->references('id')->on('modulos');
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
        Schema::dropIfExists('modulo_perfil');
    }
}
