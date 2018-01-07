<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reporteador;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaException;
use Illuminate\Support\Facades\Validator;
use App\Evssa\EvssaPropertie;
class MesaInformeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(view("lugar.mesa.informe.crear")
                         ->with([  "urlpunto"=>"listadesplieguepuntofinal",
                           "urlmesa"=>"listadesplieguemesa",
                           "urldesplieguefinal"=>"listadespliegueciudadfinal",
                           'urldesplieguedepartamento'=>'listadesplieguedepartamento',
                           "idnamefinal"=>"id_ciudad",
                           'idname'=>'id_departamento',
                           'idnamepunto'=>'id_punto',
                           'idnamemesa'=>'id_mesa'])
                         ->render());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'id_departamento' => 'required',
            'id_ciudad' =>'required',
            'id_punto'=>'required',
          ],
           [
            'id_departamento.required'=>str_replace('s$nombre$s','departamento',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
            'id_ciudad.required'=>str_replace('s$nombre$s','ciudad',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
            'id_punto.required'=>str_replace('s$nombre$s','punto de votación',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),

          ]
      );

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en pdf
    */
    public function oprimirPdf(Request $request){
      $this->validator($request->all())->validate();
      $reemplazos=array(
      "departamento"=>$request->id_departamento,
      "ciudad"=>$request->id_ciudad,
      "punto"=>$request->id_punto,
      );
      $param=array("PR_STRSQL"=>Reporteador::resuelveConsulta("0009REPORTEMESAPUNTO",$reemplazos));
      
      Reporteador::exportar("0009REPORTEMESAPUNTO",$request->tiporeporte,$param);
    }

}
