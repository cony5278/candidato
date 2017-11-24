<?php

use Illuminate\Database\Seeder;

class Departamentos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamentos')->delete();
        \App\Departamentos::create([
            'nombre'	   =>	'Boyaca',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Cundinamarca',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Amazonas',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Meta',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Pasto',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Huila',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Cauca',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Caldas',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Caqueta',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Antioquia',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Bolivar',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Magdalena',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Tolima',
        ]);
        \App\Departamentos::create([
            'nombre'	   =>	'Santander',
        ]);
    }
}
