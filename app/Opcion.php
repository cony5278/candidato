<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    //
    public function buscar(array $data){
      $opcion=$this->where("id_socioeconomica","=",empty($data['condicionsocial'])?null:$data['condicionsocial'])
                   ->where("id_poblacions","=",empty($data['poblacion'])?null:$data['poblacion'])
                   ->where("id_areaconocimientos","=",empty($data['area'])?null:$data['area'])
                   ->where("id_otros","=",empty($data['otro'])?null:$data['otro'])->first();
      if(empty($opcion)){
          $this->id_socioeconomica=empty($data['condicionsocial'])?null:$data['condicionsocial'];
          $this->id_poblacions=empty($data['poblacion'])?null:$data['poblacion'];
          $this->id_areaconocimientos=empty($data['area'])?null:$data['area'];
          $this->id_otros=empty($data['otro'])?null:$data['otro'];
          $this->save();
          return $this;
      }
      return $opcion;
    }
}
