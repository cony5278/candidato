<?php

use Illuminate\Database\Seeder;

class Mes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('mes')->delete();
      \App\Mes::create([
          'id'=>0,
          'nombre'=>	'Enero',
      ]);
      \App\Mes::create([
          'id'=>1,
          'nombre'=>	'Febrero',
      ]);
      \App\Mes::create([
          'id'=>2,
          'nombre'=>	'Marzo',
      ]);
      \App\Mes::create([
          'id'=>3,
          'nombre'=>	'Abril',
      ]);
      \App\Mes::create([
          'id'=>4,
          'nombre'=>	'Mayo',
      ]);
      \App\Mes::create([
          'id'=>5,
          'nombre'=>	'Junio',
      ]);
      \App\Mes::create([
          'id'=>6,
          'nombre'=>	'Julio',
      ]);
      \App\Mes::create([
          'id'=>7,
          'nombre'=>	'Agosto',
      ]);
      \App\Mes::create([
          'id'=>8,
          'nombre'=>	'Septiembre',
      ]);
      \App\Mes::create([
          'id'=>9,
          'nombre'=>	'Octubre',
      ]);
      \App\Mes::create([
          'id'=>10,
          'nombre'=>	'Noviembre',
      ]);
      \App\Mes::create([
          'id'=>11,
          'nombre'=>	'Diciembre',
      ]);
    }
}
