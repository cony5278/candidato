<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    public function buscar(array $data){
      $empresa=$this->where("nombre","=",$data['empresa'])->first();
      if(empty($empresa)){
        $this->nombre=empty($data['empresa'])?null:$data['empresa'];
        $this->cargo=empty($data['cargo'])?null:$data['cargo'];
        $this->save();
        return $this;
      }
      return $empresa;
    }
    public function user(){
        return $this->hasMany('App\User');
    }
}
