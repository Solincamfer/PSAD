<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LLvaeForaneaEmpleadoDirectorCargo extends Migration
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
            $table->integer('director_id')->unsigned();
            $table->integer('cargo_id')->unsigned();

            $table->foreign('director_id')->references('id')->on('directores');
            $table->foreign('cargo_id')->references('id')->on('cargos');

        }); //    

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
           $table->dropForeign('director_id');
           $table->dropForeign('cargo_id');
        });
    }
}
