<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poblacion extends Model
{
    //
    public function opcion(){
        return $this->hasMany('App\Opcion');
    }
}
