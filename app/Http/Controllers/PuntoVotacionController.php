<?php

namespace App\Http\Controllers;

use App\PuntosVotacion;
use Illuminate\Http\Request;
use App\Evssa\EvssaPropertie;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaException;
use Illuminate\Support\Facades\Validator;
use App\Ciudades;
use App\Reporteador;
use JavaScript;
class PuntoVotacionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    return response()->json(view("lugar.punto.listar")->with(["urllistar"=>"punto","urlgeneral"=>url("/"),"listapuntovotacion"=>$this->cargarListaPunto()])->render());
  }

  private function cargarListaPunto(){
    return Ciudades::join("puntos_votacions","ciudades.id","puntos_votacions.id_ciudad")->select("puntos_votacions.direccion","puntos_votacions.id","puntos_votacions.nombre","ciudades.nombre as ciudad")->paginate(10);
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
          'direccion' => 'required|string|max:255',
          'id_ciudad' => 'required|string|max:255'
        ],
        [
          'direccion.required'=>str_replace('s$nombre$s','direccion',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'id_ciudad.required'=>str_replace('s$nombre$s','ciudad',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),

        ]);

  }
  /**
   * Get the post register / login redirect path.
   *
   * @return string
   */
  public function redirectPath()
  {
      if (method_exists($this, 'redirectTo')) {
          return $this->redirectTo();
      }

      return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //

      return response()->json(view("lugar.punto.crear")->with(["formulario"=>"I",'urldespliegue'=>'listadespliegueciudad','idname'=>'id_ciudad'])->render());
  }
  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Punto de votacion
   */
  public function insertar(array $data)
  {

      $punto=new PuntosVotacion();

      $punto->nombre=$data['nombre'];
      $punto->direccion=$data['direccion'];
      $punto->id_ciudad=$data['id_ciudad'];
      $punto->save();
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try{

      $this->validator($request->all())->validate();
      $this->insertar($request->all());

      return response()->json([
          EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
          EvssaConstantes::MSJ=>"Se ha insertado correctamente la punto.",
          "html"=>response()->json(view("lugar.punto.listar")->with(["urllistar"=>"punto","urlgeneral"=>url("/"),"listapuntovotacion"=>$this->cargarListaPunto()])->render())
      ]);
    } catch (EvssaException $e) {
        return response()->json([
            EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
            EvssaConstantes::MSJ=>$e->getMensaje(),
        ],400);
    } catch (\Illuminate\Database\QueryException $e) {
         return response()->json([
             EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
             EvssaConstantes::MSJ=>"Registro secundario encontrado",
         ],400);
    }

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
    $punto=PuntosVotacion::find($id);
    return response()->json(view("lugar.punto.crear")->with(["formulario"   =>"A",
                                                              'urldespliegue'=>'listadespliegueciudad',
                                                              'idname'=>'id_ciudad',
                                                              'punto'=>$punto,
                                                              'objeto'=>Ciudades::find($punto->id_ciudad)])->render());

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
    try{

        $this->validator($request->all())->validate();
        $this->actualizar(PuntosVotacion::find($id),$request->all());
        return response()->json([
            EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
            EvssaConstantes::MSJ=>"Se ha actualizado correctamente el punto de votación.",
            "html"=>response()->json(view("lugar.punto.listar")->with(["urllistar"=>"punto","urlgeneral"=>url("/"),"listapuntovotacion"=>$this->cargarListaPunto()])->render())
        ]);
      } catch (EvssaException $e) {
          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
              EvssaConstantes::MSJ=>$e->getMensaje(),
          ],400);
      } catch (\Illuminate\Database\QueryException $e) {
           return response()->json([
               EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
               EvssaConstantes::MSJ=>"Registro secundario encontrado",
           ],400);
      }
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Ciudad
   */
  private function actualizar($punto,array $data)
  {


      $punto->nombre=$data['nombre'];
      $punto->id_ciudad=$data['id_ciudad'];
      $punto->direccion=$data['direccion'];
      $punto->save();
}
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
       try {
         PuntosVotacion::find($id)->delete();
         return response()->json([
             EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
             EvssaConstantes::MSJ=>"Se ha eliminado correctamente el registro.",
             "html"=>response()->json(view("lugar.punto.listar")->with(["urllistar"=>"punto","urlgeneral"=>url("/"),"listapuntovotacion"=>$this->cargarListaPunto()])->render())
         ]);
        } catch (EvssaException $e) {
            return response()->json([
                EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
                EvssaConstantes::MSJ=>$e->getMensaje(),
            ],400);
        } catch (\Illuminate\Database\QueryException $e) {
             return response()->json([
                 EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
                 EvssaConstantes::MSJ=>"Registro secundario encontrado",
             ],400);
        }
  }
  /**
  *lista todos los ciudades
  */

  public function cargarListaCombo(Request $request)
  {

      if($request->ajax()){
          return response()->json($this->buscar("combos.grande",$request)->render());
      }else{
          return $this->buscar('combos.grande',$request);
      }
  }

  private function buscar($vista,Request $request)
  {
      $ciudades=new Ciudades();
      return view($vista)->with([
          "departamentos"=>$ciudades->getListarCiudades($request),
          "entrada"=>"entrada-ciudad",
          "entradaid"=>"entrada-ciudad-id"
      ]);
  }
  public function cargarDespliegueCombo(Request $request){

    $ciudad=new Ciudades();

    return response()->json(view("combos.despliegue")->with(["lista"=>$ciudad->getListarCiudadDespliegue($request->buscar)])->render());
  }
  public function cargarDespliegueComboFinal(Request $request){

        $punto=new PuntosVotacion();
    return response()->json(view("combos.desplieguepunto")->with(["listapunto"=>$punto->getListarpuntoDespliegueFinal($request)])->render());

  }
  public function refrescar(Request $request){
    return response()->json(view("lugar.punto.tabla")->with(["urllistar"=>"punto","urlgeneral"=>url("/"),"listapuntovotacion"=>Ciudades::join("puntos_votacions","ciudades.id","puntos_votacions.id_ciudad")->orWhere("puntos_votacions.nombre","like","%".$request->buscar."%")->orWhere("puntos_votacions.direccion","like","%".$request->buscar."%")->orWhere("ciudades.nombre","like","%".$request->buscar."%")->select("puntos_votacions.direccion","puntos_votacions.id","puntos_votacions.nombre","ciudades.nombre as ciudad")->paginate(10)
    ])->render());
  }


  public function googleMaps(){
    JavaScript::put([
    			'puntos' =>\DB::table('departamentos')
                                 ->join("ciudades","departamentos.id","ciudades.id_departamento")
                                 ->join("puntos_votacions","ciudades.id","puntos_votacions.id_ciudad")
                                 ->join("mesas_votacions","puntos_votacions.id","mesas_votacions.id_punto")
                                 ->join("users","mesas_votacions.id","users.id_mesa")
                                 ->select(\DB::raw('COUNT(puntos_votacions.id) as contar, puntos_votacions.direccion,ciudades.nombre,puntos_votacions.id'))
                                 ->groupBy('puntos_votacions.direccion','ciudades.nombre','puntos_votacions.id')
                                 ->orderBy('puntos_votacions.id','desc')
                                 ->get()
    		,
      'usuarios'=>\DB::table('departamentos')
                             ->join("ciudades","departamentos.id","ciudades.id_departamento")
                             ->join("puntos_votacions","ciudades.id","puntos_votacions.id_ciudad")
                             ->join("mesas_votacions","puntos_votacions.id","mesas_votacions.id_punto")
                             ->join("users","mesas_votacions.id","users.id_mesa")
                             ->select(\DB::raw('puntos_votacions.id,users.name,users.name2,users.lastname,users.lastname2,users.nit'))
                             ->orderBy('puntos_votacions.id','desc')
                             ->get()
      ]);
    return view('maps.mapa');
  }
  /**
  *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en pdf
  */
  public function oprimirPdf($buscar){

    $reemplazos=array(
      "buscar"=>str_replace(" ",".c*",$buscar)
    );
    $param=array("PR_STRSQL"=>Reporteador::resuelveConsulta("002PUNTOSVOTACION",$reemplazos));

    Reporteador::exportar("002PUNTOSVOTACION",EvssaConstantes::PDF,$param);
  }

  /**
  *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en excel
  */
  public function oprimirExcel($buscar){
    $reemplazos=array(
      "buscar"=>str_replace(" ",".c*",$buscar)
    );
    $param=array("PR_STRSQL"=>Reporteador::resuelveConsulta("002PUNTOSVOTACION",$reemplazos));

    Reporteador::exportar("002PUNTOSVOTACION",EvssaConstantes::EXCEL,$param);
  }
}
