<?php

use Illuminate\Database\Seeder;

class Poblacion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('poblacions')->delete();
        \App\Poblacion::create([
            'nombre'	   =>	'LGBTI',
        ]);
        \App\Poblacion::create([
            'nombre'	   =>	'Blanco',
        ]);
        \App\Poblacion::create([
            'nombre'	   =>	'Negritudes',
        ]);
        \App\Poblacion::create([
            'nombre'	   =>	'Indígena',
        ]);
        \App\Poblacion::create([
            'nombre'	   =>	'Juventud',
        ]);
        \App\Poblacion::create([
            'nombre'	   =>	'Discapacitado',
        ]);
        \App\Poblacion::create([
            'nombre'	   =>	'Víctima',
        ]);
        \App\Poblacion::create([
            'nombre'	   =>	'Desplazado',
        ]);
        \App\Poblacion::create([
            'nombre'	   =>	'Religión',
        ]);
        \App\Poblacion::create([
            'nombre'	   =>	'Cabeza de Familia',
        ]);
        \App\Poblacion::create([
            'nombre'	   =>	'Jóven Profesional',
        ]);

    }
}
