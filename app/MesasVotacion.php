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
        'numero', 'id'
    ];


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
}
