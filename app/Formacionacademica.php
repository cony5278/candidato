<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formacionacademica extends Model
{
    //

    public function users(){
        return $this->belongsTo('App\users');
    }

    public function nivel(){
        return $this->belongsTo('App\Nivelacademico');
    }
    public function eliminar($usuario,array $data){
      $formacions=$this->where("user_id","=",$usuario->id)->get();
      if(!empty($data['idforomacionacademica'])){
        foreach ($formacions As $formacion){
            if (!in_array($formacion->id, $data['idforomacionacademica'])) {
              $formacion->delete();
            }
        }
      }elseif(!empty($formacions->first())){
            $formacions->first()->delete();

      }
    }
}
