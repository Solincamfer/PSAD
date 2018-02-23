<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignMarcaPieza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marcapieza', function (Blueprint $table) {
            $table->foreign('pieza_id')->references('id')->on('piezas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marcapieza', function (Blueprint $table) {
           $table->dropForeign('pieza_id');
        });
    }
}
