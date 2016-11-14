<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaDepartamentos extends Migration
{
    public $timestamps=false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_d');
            $table->string('nombre_d',100);
           
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
}
