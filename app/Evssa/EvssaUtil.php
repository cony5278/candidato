<?php

namespace App\Evssa;

use App\Evssa\EvssaConstantes;
use Illuminate\Support\Facades\Session;

class EvssaUtil {


    /**
     * constructor de la clase recibe un archivo
     * @param  $file
     */
    public function __construct ()
    {

    }

    public static function agregarMensajeAlerta($mensaje){
      self::agregar($mensaje,EvssaConstantes::WARNING);
    }

    public static function agregarMensajeError(){
      self::agregar($mensaje,EvssaConstantes::DANGER);
    }

    public static function agregarMensajeInformativo($mensaje){
      self::agregar($mensaje,EvssaConstantes::INFO);
    }

    public static function agregarMensajeConfirmacion($mensaje){
        self::agregar($mensaje,EvssaConstantes::SUCCESS);
    }

    private static function agregar($mensaje,$notificacion){
      Session::flash(EvssaConstantes::NOTIFICACION,$notificacion);
      Session::flash(EvssaConstantes::MSJ,$mensaje);
    }
    public static function borrar(){
      Session::forget(EvssaConstantes::NOTIFICACION);
      Session::forget(EvssaConstantes::MSJ);
    }

  /**
  *AGREGAR SECCIONES A LA PAGINA
  **/
  public static function agregarSeccion($var,$id=NULL,$urllistar){
      Session::flash(EvssaConstantes::SECCION,$var);
      Session::flash(EvssaConstantes::URLLISTAR,$urllistar);

      if($id!=NULL){
          Session::flash(EvssaConstantes::SECCIONID,$var);
      }
  }

  public static function borrarSeccion(){
      Session::forget(EvssaConstantes::SECCION);
      Session::forget(EvssaConstantes::URLLISTAR);
      Session::forget(EvssaConstantes::SECCIONID);
  }





}
