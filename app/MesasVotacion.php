<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MesasVotacion extends Model
{
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numero', 'id','id_punto'
    ];

    public function getListaMesa($buscar){
            return $this->where("numero","like","".$buscar."%")->get();
    }
    public function buscar($numero,$puntovotacion){
        $mesa= $this->where("numero","=",$numero)->where("id_punto","=",$puntovotacion->id)->first();
        if(empty($mesa)){
            return $this->crear($numero,$puntovotacion);
        }
        return $mesa;
    }
    public function crear($numero,$puntovotacion){
        $this->numero=$numero;
        $this->id_punto=$puntovotacion->id;
        $this->save();
        return $this;
    }

    public function user(){
        return $this->hasMany('App\User');
    }

    public function puntovotacion(){
        return $this->belongsTo('App\PuntosVotacion');
    }
}
