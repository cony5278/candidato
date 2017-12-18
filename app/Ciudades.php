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
      'nombre'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'id','id_departamento'
  ];

  function getListarCiudadDespliegue($buscar){
      return $this->where('nombre','like','%'.$buscar.'%')->get();
  }

    function getListarCiudades(Request $request){
      return $this->where("id_departamento","=",$request->iddepartamento)->where('nombre','like','%'.$request->ciudad.'%')->paginate(5);
    }

    public function buscar($nombre,$departamento){
        $ciudad= collect(\DB::select("select * from ciudades where upper(nombre) = upper('".$nombre."') and id_departamento=".$departamento->id))->first();
        if(empty($ciudad)){
            return $this->crear($nombre,$departamento);
        }
        return $ciudad;
    }


    public function crear($nombre,$departamento){
        $this->nombre=$nombre;
        $this->id_departamento=$departamento->id;
        $this->save();
        return $this;
    }

    public function puntosvotacion(){
        return $this->hasMany('App\PuntosVotacion');
    }
    public function getListarCiudadDespliegueFinal(Request $request){

          return $this->where('nombre','like','%'.$request->buscar.'%')->where("id_departamento","=",$request->id)->get();
    }
}
