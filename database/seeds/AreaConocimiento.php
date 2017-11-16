<?php

use Illuminate\Database\Seeder;

class AreaConocimiento extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areaconocimientos')->delete();
        \App\Areaconocimiento::create([
            'nombre'	   =>	'Ciencias Económicas',
        ]);
        \App\Areaconocimiento::create([
            'nombre'	   =>	'Arquitectura y Diseño',
        ]);
        \App\Areaconocimiento::create([
            'nombre'	   =>	'Artes y Humanidades',
        ]);
        \App\Areaconocimiento::create([
            'nombre'	   =>	'Ciencias Sociales',
        ]);
        \App\Areaconocimiento::create([
            'nombre'	   =>	'Derecho',
        ]);
        \App\Areaconocimiento::create([
            'nombre'	   =>	'Ciencias Naturales',
        ]);
        \App\Areaconocimiento::create([
            'nombre'	   =>	'Ingeniería',
        ]);
        \App\Areaconocimiento::create([
            'nombre'	   =>	'Ciencias de la Salud',
        ]);
        \App\Areaconocimiento::create([
            'nombre'	   =>	'Deportes',
        ]);
    }
}
