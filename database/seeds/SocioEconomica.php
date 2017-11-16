<?php

use Illuminate\Database\Seeder;

class SocioEconomica extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socioeconomicas')->delete();
        \App\Socioeconomica::create([
            'nivel'	   =>	'Bajo',
        ]);
        \App\Socioeconomica::create([
            'nivel'	   =>	'Medio Bajo',
        ]);
        \App\Socioeconomica::create([
            'nivel'	   =>	'Medio',
        ]);
        \App\Socioeconomica::create([
            'nivel'	   =>	'Medio Alto',
        ]);
        \App\Socioeconomica::create([
            'nivel'	   =>	'Alto',
        ]);

    }
}
