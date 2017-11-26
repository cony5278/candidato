<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formacionacademica extends Model
{
    //

    public function users(){
        return $this->belongsTo('App\users');
    }
}
