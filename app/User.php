<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','nit'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAllUsuarioAdmin($tipo){
        return $this->where("type",$tipo)->paginate(10);
    }
    public function getAllUsuarioTodo(){
        return $this->paginate(10);
    }
    public function actualizar(Request $request, $id){
        $registro=$this->where('id', '=', $id)->first();
        $registro->name=$request->name;
        $registro->name2=$request->name2;
        $registro->lastname=$request->lastname;
        $registro->lastname2=$request->lastname2;
        $registro->password=$request->password;
        $registro->email=$request->email;
        $registro->save();
    }
    public function getUsuarioTipo($id){
       return $this->where('id', '=', $id)->where('type','=',\Auth::user()->type=='S'?'A':'E')->first();
    }

    public function formacionacademica(){
        return $this->hasMany('App\Formacionacademica');
    }
    public function opcion(){
      return $this->join('opcions', 'opcions.id', '=','users.id_opcions')
                  ->leftJoin('socioeconomicas','socioeconomicas.id','=','opcions.id_socioeconomica')
                  ->leftJoin('poblacions','poblacions.id','=','opcions.id_poblacions')
                  ->leftJoin('areaconocimientos','areaconocimientos.id','=','opcions.id_areaconocimientos')
                  ->leftJoin('otros','otros.id','=','opcions.id_otros')
                  ->select("otros.*",
                       "areaconocimientos.*",
                       "areaconocimientos.*",
                       "poblacions.*",
                       "socioeconomicas.*",
                       "opcions.*",
                       "users.*")->where("users.id","=",$this->id)->first();

    }
    public function mesa(){
        return $this->join('mesas_votacions','mesas_votacions.id','=','users.id_mesa')
                    ->join('puntos_votacions','puntos_votacions.id','=','mesas_votacions.id_punto')
                    ->join('ciudades','ciudades.id','=','puntos_votacions.id_ciudad')
                    ->join('departamentos','departamentos.id','=','ciudades.id_departamento')
                    ->select("departamentos.nombre as departamento",
                             "departamentos.id as id_departamento",
                             "ciudades.nombre as ciudad",
                             "ciudades.id as id_ciudad",
                             "puntos_votacions.*",
                             "mesas_votacions.id as id_mesa",
                             "mesas_votacions.numero")
                    ->where("users.id","=",$this->id)->first();

    }
    public function empresas(){
        return $this->join('empresas','empresas.id','=','users.id_empresa')
                    ->select("empresas.*")
                    ->where("users.id","=",$this->id)->first();
    }


}
