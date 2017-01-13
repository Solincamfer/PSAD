<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TipoEquipoComponente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamps=false;
    public function up()
    {
        Schema::create('ecomponente_tequipo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ecomponente_id')->unsigned();
            $table->integer('tequipo_id')->unsigned();
            $table->foreign('ecomponente_id')->references('id')->on('ecomponentes');
            $table->foreign('tequipo_id')->references('id')->on('tequipos');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecomponente_tequipo');
    }
}
