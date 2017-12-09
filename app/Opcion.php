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
          $this->id_socioeconomica=$data['condicionsocial']==0?null:$data['condicionsocial'];
          $this->id_poblacions=$data['poblacion']==0?null:$data['poblacion'];
          $this->id_areaconocimientos=$data['area']==0?null:$data['area'];
          $this->id_otros=$data['otro']==0?null:$data['otro'];
          $this->save();
          return $this;
      }
      return $opcion;
    }

    public function user(){
        return $this->hasMany('App\User');
    }
    public function condicionsocio(){
          return $this->belongsTo('App\Socioeconomica');
    }
    public function otro(){
        return $this->belongsTo('App\Otro');
    }
    public function poblacion(){
        return $this->belongsTo('App\Poblacion');
    }
}
