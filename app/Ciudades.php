<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Ciudades extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    function getListarCiudades(Request $request){
      return $this->where("id_departamento","=",$request->iddepartamento)->where('nombre','like','%'.$request->ciudad.'%')->paginate(5);
    }
}
