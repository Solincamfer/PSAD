<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPlanes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamps=false;
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombreP',200);
            $table->integer('descuento')->unsigned();
            $table->integer('status')->unsigned();
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planes');
    }
}
