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

    function getListarDepartamentosDespliegue($buscar){
        return $this->where('nombre','like','%'.$buscar.'%')->get();
    }

    function getListarDepartamentos($buscar){
        return $this->where('nombre','like','%'.$buscar.'%')->paginate(5);
    }

    public function buscar($nombre){
        $departamento=collect(\DB::select("select * from departamentos where upper(nombre) = upper('".$nombre."')"))->first();

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
