<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // $this->call(UsersTableSeeder::class);
        $this->call(NivelAcademico::class);
        $this->call(Otro::class);
        $this->call(AreaConocimiento::class);
        $this->call(Poblacion::class);
        $this->call(SocioEconomica::class);

        $this->call(Ano::class);
        $this->call(Mes::class);
          $this->call(Compania::class);
        Model::reguard();
    }
}
