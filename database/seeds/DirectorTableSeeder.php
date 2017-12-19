<?php

use Illuminate\Database\Seeder;

class DirectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('directores')->insert([
    		'descripcion'=>'Operaciones',
    		'status'=>1
    	]);
    }
}
