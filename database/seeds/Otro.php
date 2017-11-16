<?php

use Illuminate\Database\Seeder;

class Otro extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('otros')->delete();
        \App\Otro::create([
            'nombre'	   =>	'Líder Social',
        ]);
        \App\Otro::create([
            'nombre'	   =>	'Provincia',
        ]);
        \App\Otro::create([
            'nombre'	   =>	'Desempleado',
        ]);
        \App\Otro::create([
            'nombre'	   =>	'Animalista',
        ]);
        \App\Otro::create([
            'nombre'	   =>	'Ambientalista',
        ]);
        \App\Otro::create([
            'nombre'	   =>	'Adulto Mayor',
        ]);
        \App\Otro::create([
            'nombre'	   =>	'Gobierno',
        ]);
        \App\Otro::create([
            'nombre'	   =>	'Empresario',
        ]);
    }
}
