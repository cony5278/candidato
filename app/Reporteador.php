<?php

namespace App;


use App\EvssaConstantes;
use JasperPHP\JasperPHP;
class Reporteador {
    /**
     * constructor de la clase recibe un archivo
     * @param  $file
     */
    public function __construct ()
    {

    }
    private static function cabeceras($nombre,$formato,$file){
       header('Content-Description: File Transfer');
       header('Content-Type: application/octet-stream');
       header('Content-Disposition: attachment; filename="'.$nombre.'.'.$formato.'"');
       header('Expires: 0');
       header('Cache-Control: must-revalidate');
       header('Pragma: public');
       header('Content-Length: ' . filesize($file));
    }
    public static function exportar($nombre,$formato){

      switch ($formato) {
        case EvssaConstantes::XLSX:
              self::descargar($nombre,$formato);
          break;
        case EvssaConstantes::XLS:
                self::descargar($nombre,$formato);
          break;
        case EvssaConstantes::PDF:
              self::descargar($nombre,$formato);
          break;
        default:
          # code...
          break;
      }
  }
  private static function descargar($nombre,$formato){
      $jasper = new JasperPHP;
      $output = public_path('archivos').'\informes';
      $input =$output.'\\'.$nombre.'.jrxml';

      $jasper->process(
                $input,
                $output,
                array($formato),
                array(),
                \Config::get('database.connections.mysql')
      )->execute();

      $file = $output .'\\'.$nombre.'.'.$formato;
      $path = $file;
      if (!file_exists($file)) {
          abort(404);
      }
      $file = file_get_contents($file);
      self::cabeceras($nombre,$formato,$path);
      flush();
      readfile($path);
      unlink($path);
    }
}
