<?php

use Illuminate\Database\Seeder;

class DepartamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('departamentos')->insert([
    		'descripcion'=>'RRHH',
    		'status'=>1,
    		'director_id'=>1
    	]);
       DB::table('departamentos')->insert([
    		'descripcion'=>'DESARROLLO',
    		'status'=>1,
    		'director_id'=>1
    	]);
       DB::table('departamentos')->insert([
    		'descripcion'=>'SOFTWARE',
    		'status'=>1,
    		'director_id'=>1
    	]);
       DB::table('departamentos')->insert([
    		'descripcion'=>'HARDWARE',
    		'status'=>1,
    		'director_id'=>1
    	]);
       DB::table('departamentos')->insert([
    		'descripcion'=>'INFRAESTRUCTURA',
    		'status'=>1,
    		'director_id'=>1
    	]);
       DB::table('departamentos')->insert([
    		'descripcion'=>'COMPRAS',
    		'status'=>1,
    		'director_id'=>1
    	]);
    }
}
