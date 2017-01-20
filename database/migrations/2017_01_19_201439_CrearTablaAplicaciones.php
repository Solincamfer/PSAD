<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAplicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicaciones', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('descripcion',100);
            $table->string('licencia',100);
            $table->string('version',100);
            $table->integer('status');
            $table->integer('equipo_id')->unsigned();
            $table->foreign('equipo_id')->references('id')->on('equipos');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aplicaciones');
    }
}