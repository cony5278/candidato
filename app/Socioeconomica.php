<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socioeconomica extends Model
{
    //
    public function opcion(){
        return $this->hasMany('App\Opcion');
    }
}
