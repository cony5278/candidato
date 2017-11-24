<?php

use Illuminate\Database\Seeder;

class MesaVotacion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mesas_votacions')->delete();
        \App\Departamentos::create([
            'numero'	   =>	'',
        ]);
    }
}
