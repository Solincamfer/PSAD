<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearCampoStatusParaResponsables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamps=false;
    public function up()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->integer('statusR')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropColumn('statusR');
        });
    }
}
