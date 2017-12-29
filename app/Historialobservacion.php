<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historialobservacion extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'observacion','id_user','id_observador',
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'id',
  ];

  public function historialObservacion($id){
    return $this->join('users as observador','observador.id','=','historialobservacions.id_observador')
                ->join('users as usuario','historialobservacions.id_user','=','usuario.id')
                ->where('historialobservacions.id_user','=',$id)
                ->select("observador.name as nombreobservador",
                          "observador.name2 as nombre2observador",
                          "observador.lastname as apellidoobservador",
                          "observador.lastname2 as apellido2observador",
                          "usuario.name as nombreusuario",
                          "usuario.name2 as nombre2usuario",
                          "usuario.lastname as apellidousuario",
                          "usuario.lastname2 as apellido2usuario",
                          "historialobservacions.*",
                          "observador.photo",
                          "observador.type"
                          )
                ->get();
            }

    public function nivel(){
        return $this->belongsTo('App\User');
    }
}
