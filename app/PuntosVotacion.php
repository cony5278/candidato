<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntosVotacion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'direccion','id'
    ];
    function getListarPuntoDespliegue($buscar){
        return $this->where('nombre','like','%'.$buscar.'%')->get();
    }

    public function buscar($direccion,$idciudad){
        $puntovotacion= $this->where("id_ciudad","=",$idciudad)->first();
        if(empty($puntovotacion)){
            return $this->crear($direccion,$idciudad);
        }
        return $puntovotacion;
    }
    public function  crear($direccion,$idciudad){
        $this->direccion=$direccion;
        $this->id_ciudad=$idciudad;
        $this->save();
        return $this;
    }
    public function mesa(){
        return $this->hasMany('App\MesasVotacion');
    }

    public function ciudad(){
        return $this->belongsTo('App\Ciudades');
    }

    public function departamento(){
        return $this->belongsTo('App\Departamentos');
    }
}
