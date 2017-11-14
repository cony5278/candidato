<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Archivos {

    private $file;

    /**
     * constructor de la clase recibe un archivo
     * @param  $file
     */
    public function __construct ($file)
    {

        $this -> file = $file;

    }

    /**
     * metodo utilizado para visualizar los archivos en la publicacion
     *
     * @param $nombreArchivo
     * @param $extension
     * @return null|string
     */
    public function cadenaExtension ($nombreArchivo , $extension , $date)
    {

        return $this -> renderizarExtension ( $extension, $nombreArchivo,
            $date );

    }

    /**
     * metodo que seleccionar de acuerdo a la extension la imagen para renderizarlo en el lado del cliente
     *
     * @param $extension
     * @param $nombreArchivo
     * @return null|string
     */
    private function renderizarExtension ($extension , $nombreArchivo , $date)
    {

        switch ( $extension )
        {
            case EvssaConstantes :: XLS :
                return EvssaConstantes :: RUTA_IMG .
                    EvssaConstantes :: XLS . "." . EvssaConstantes :: JPG;
                break;
            case EvssaConstantes :: CSV :
                return EvssaConstantes :: RUTA_IMG .
                    EvssaConstantes :: CSV . "." . EvssaConstantes :: JPG;
                break;
            case EvssaConstantes :: XLSX :
                return EvssaConstantes :: RUTA_IMG .
                    EvssaConstantes :: XLS . "." . EvssaConstantes :: JPG;
                break;
            case EvssaConstantes :: PDF :
                return EvssaConstantes :: RUTA_IMG .
                    EvssaConstantes :: PDF . "." . EvssaConstantes :: JPG;
                break;
            case EvssaConstantes :: DOCX :
                return EvssaConstantes :: RUTA_IMG .
                    EvssaConstantes :: DOCX . "." . EvssaConstantes :: JPG;
                break;
            case EvssaConstantes :: DOC :
                return EvssaConstantes :: RUTA_IMG .
                    EvssaConstantes :: DOCX . "." . EvssaConstantes :: JPG;
                break;
            default :
                return EvssaConstantes :: RUTA . EvssaConstantes :: BARRA .
                    EvssaConstantes :: ARCHIVOS . EvssaConstantes :: BARRA . $this -> nombreRutaArchivos (
                        $date, $extension, $nombreArchivo ) . '.' . $extension;
                break;
        }
        return null;

    }

    /**
     * nombre de la ruta de los archivos
     * @param  $dateServidor
     * @param  $extension
     * @param  $nombre
     * @return string
     */
    private function nombreRutaArchivos ($extension , $nombre)
    {
        return Auth :: user ( ) -> type . '/'.Auth :: user ( ) -> id . '/' . $extension . '/' .
            $nombre;

    }

    /**
     * nombre de la ruta del archivo
     * @param  $dateServidor
     * @return string
     */
    private function nombreRutaArchivo ()
    {

        return $this -> nombreRutaArchivos ( $this -> file -> getClientOriginalExtension ( ),
            $this -> file -> getClientOriginalName ( ) );

    }

    /**
     * metodo que guarda el archivo en la ruta especifica
     */
    public function guardarArchivo ()
    {
        Storage :: disk ( EvssaConstantes :: LOCAL ) -> put (
            $this -> nombreRutaArchivo (  ),
            File :: get ( $this -> file ) );

    }

    public function getArchivoNombreExtension(){
        return $this -> file -> getClientOriginalName ( );
    }


}
