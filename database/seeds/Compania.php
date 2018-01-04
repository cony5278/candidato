<?php

use Illuminate\Database\Seeder;

class Compania extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('companias')->delete();
      \App\Compania::create([
          'id'=>1,
          'imagen'	   =>	'default.png',
          'ancho'=>200,
          'alto'=>200,
          'meta'=>0,
      ]);
    }
}
