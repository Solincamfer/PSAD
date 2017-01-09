<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAcciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public $timestamps=false;
     public function up()
    {
        Schema::create('acciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_ac')->default(0);
            $table->string('descripcion',100);
            $table->string('url',100);
            $table->string('data_toogle',100);
            $table->string('clase_css',100);
            $table->integer('submodulo_id')->unsigned();
            $table->integer('accion_id')->unsigned();
            $table->foreign('submodulo_id')->references('id')->on('submodulos')->ondelate('cascade');
            $table->foreign('accion_id')->references('id')->on('acciones')->ondelate('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acciones');
    }
}
