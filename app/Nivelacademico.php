<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivelacademico extends Model
{
    //
    public function formacionacademica(){
        return $this->hasMany('App\Formacionacademica');
    }
}
