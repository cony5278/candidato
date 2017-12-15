<?php

namespace App\Evssa;


class EvssaException extends Exception{


    /**
     * constructor de la clase recibe un archivo
     * @param  $file
     */
    public function __construct ()
    {
    }


    public function getMensaje($mensaje){
      throw new \Exception($mensaje);
    }


}
