<?php

use Illuminate\Database\Seeder;


class NivelAcademico extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nivelacademicos')->delete();
        \App\Nivelacademico::create([
            'nombre'	   =>	'Técnico',
         ]);
        \App\Nivelacademico::create([
            'nombre'	   =>	'Bachiller',
        ]);
        \App\Nivelacademico::create([
            'nombre'	   =>	'Técnologo',
        ]);
        \App\Nivelacademico::create([
            'nombre'	   =>	'Profesional',
        ]);
        \App\Nivelacademico::create([
            'nombre'	   =>	'Master',
        ]);
        \App\Nivelacademico::create([
        'nombre'	   =>	'Especialista',
          ]);
        \App\Nivelacademico::create([
            'nombre'	   =>	'Otro',
        ]);
    }
}
