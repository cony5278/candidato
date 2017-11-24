<?php

use Illuminate\Database\Seeder;

class Ciudades extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ciudades')->delete();
        \App\Ciudades::create([
            'id_departamento'=>1,
            'nombre'	   =>	'Duitama',
        ]);
        \App\Ciudades::create([
            'id_departamento'=>1,
            'nombre'	   =>	'Tunja',
        ]);
        \App\Ciudades::create([
            'id_departamento'=>1,
            'nombre'	   =>	'Pipa',
        ]);
        \App\Ciudades::create([
            'id_departamento'=>1,
            'nombre'	   =>	'Nobsa',
        ]);
        \App\Ciudades::create([
            'id_departamento'=>1,
            'nombre'	   =>	'Toca',
        ]);
        \App\Ciudades::create([
            'id_departamento'=>1,
            'nombre'	   =>	'Guacamayas',
        ]);
        \App\Ciudades::create([
            'id_departamento'=>1,
            'nombre'	   =>	'Panqueba',
        ]);
        \App\Ciudades::create([
            'id_departamento'=>1,
            'nombre'	   =>	'Pajarito',
        ]);
        \App\Ciudades::create([
            'id_departamento'=>1,
            'nombre'	   =>	'Paya',
        ]);
        \App\Ciudades::create([
            'id_departamento'=>1,
            'nombre'	   =>	'Macanal',
        ]);
        \App\Ciudades::create([
            'id_departamento'=>1,
            'nombre'	   =>	'Santa Maria',
        ]);
    }
}
