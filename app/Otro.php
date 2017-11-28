<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otro extends Model
{
    //
    public function opcion(){
        return $this->hasMany('App\Opcion');
    }
}
