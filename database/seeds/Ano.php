<?php

use Illuminate\Database\Seeder;

class Ano extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('anos')->delete();
        for ($i = 1; $i <= 400; $i++) {
          \App\Ano::create([
              'id'=>$i,
              'numero'=>1900+$i,
          ]);
        }
    }
}
