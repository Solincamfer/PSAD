<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaConponentePieza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamps=false;
    public function up()
    {
        Schema::create('ecomponente_epieza', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ecomponente_id')->unsigned();
            $table->integer('epieza_id')->unsigned();
            $table->foreign('ecomponente_id')->references('id')->on('ecomponentes');
            $table->foreign('epieza_id')->references('id')->on('epiezas');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecomponente_epieza');
    }
}
