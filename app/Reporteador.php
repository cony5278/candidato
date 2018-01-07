<?php

namespace App;


use App\Evssa\EvssaConstantes;
use JasperPHP\JasperPHP;
use App\Consulta;
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
    public static function exportar($nombre,$formato,$param){

      if($formato==EvssaConstantes::EXCEL) {

              return self::descargar($nombre,$formato,$param);
      }
          if($formato==EvssaConstantes::EXCEL10){
                return self::descargar($nombre,$formato,$param);
      }
          if($formato==EvssaConstantes::PDF)  {
              return self::descargar($nombre,$formato,$param);

      }


  }

  private static function descargar($nombre,$formato,$param){
      $jasper = new JasperPHP;
      $output = public_path('archivos').'\informes';
      $input =$output.'\\'.$nombre.'.jrxml';
      $jasper->process(
                $input,
                $output,
                array($formato),
                $param,
                \Config::get('database.connections.mysql')
      )->execute();

      $file = $output .'\\'.$nombre.'.'.$formato;
      $path = $file;
      if (!file_exists($file)) {
          abort(404);
      }
      $file = file_get_contents($file);
      self::cabeceras($nombre,$formato,$path);
      readfile($path);

    }


    public static function resuelveConsulta($codigo , $reemplazos=array()){

      $consulta=Consulta::where("codigo","=",$codigo)->first()->consulta;

      foreach ($reemplazos as $key => $value){
           $consulta=str_replace('s$'.$key.'$s',$value,$consulta);
      }
      return $consulta;
    }
}
