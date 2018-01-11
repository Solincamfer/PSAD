<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LLaveForaneaEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) 
        {
            $table->integer('cedula_id')->unsigned();
            $table->integer('rif_id')->unsigned();
            $table->integer('correo_id')->unsigned();

            $table->foreign('cedula_id')->references('id')->on('cedulas');
            $table->foreign('rif_id')->references('id')->on('rifs');
            $table->foreign('correo_id')->references('id')->on('correos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

         Schema::table('empleados', function (Blueprint $table) 
        {
           $table->dropForeign('cedula_id');
           $table->dropForeign('rif_id');
           $table->dropForeign('correo_id');

        });
        
    }
}
