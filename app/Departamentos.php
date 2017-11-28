<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
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

    function getListarDepartamentos($buscar){
        return $this->where('nombre','like','%'.$buscar.'%')->paginate(5);
    }

    public function buscar($nombre){
        $departamento=$this->where('nombre','like','%'.$nombre.'%')->first();

        if(empty($departamento)){
            return $this->crear($nombre);
        }
        return $departamento;
    }
    public function crear($nombre){
        $this->nombre=$nombre;
        $this->save();
        return $this;
    }

    public function ciudad(){
        return $this->hasMany('App\Ciudades');
    }
}
