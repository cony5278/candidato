<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
    function getBuscarDireccion($direccion,$ciudad){
       $punto=collect(\DB::select("select * from puntos_votacions where upper(direccion) = upper('".$direccion."') and id_ciudad =".$ciudad->id))->first();
       if(!empty($punto)){
         return $punto;
       }
       return $this->crear($direccion,$ciudad);
    }
    function getListarPuntoDespliegue($buscar){
        return $this->where('nombre','like','%'.$buscar.'%')->get();
    }
    function getListarpuntoDespliegueFinal(Request $request){

      return $this->where('direccion','like','%'.$request->buscar.'%')->where("id_ciudad","=",$request->id)->get();
    }

    public function  crear($direccion,$ciudad){
        $this->direccion=$direccion;
        $this->id_ciudad=$ciudad->id;
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
    public function agrupado(){

    }
}
