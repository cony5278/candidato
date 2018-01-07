<?php

namespace App\Http\Controllers;

use App\PuntosVotacion;
use App\MesasVotacion;
use Illuminate\Http\Request;
use App\Evssa\EvssaPropertie;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaException;
use App\Departamentos;
use Illuminate\Support\Facades\Validator;
use App\Reporteador;

class MesaVotacionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    return response()->json(view("lugar.mesa.listar")->with(["urllistar"=>"mesa","urlgeneral"=>url("/"),"listadesplieguemesa"=>$this->cargarListaMesa()])->render());
  }

  private function cargarListaMesa(){
    return Departamentos::join("ciudades","departamentos.id","ciudades.id_departamento")
                        ->join("puntos_votacions","ciudades.id","puntos_votacions.id_ciudad")
                        ->join("mesas_votacions","puntos_votacions.id","mesas_votacions.id_punto")
                        ->join("users","mesas_votacions.id","users.id_mesa")
                        ->select("departamentos.nombre as departamento",
                                 "ciudades.nombre as ciudad",
                                 "puntos_votacions.direccion",
                                 "mesas_votacions.numero",
                                 "mesas_votacions.id",
                                 "users.name",
                                 "users.name2",
                                 "users.lastname",
                                 "users.lastname2")->paginate(10);
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
          'numero' => 'required|string|max:255',
          'id_punto' => 'required|string|max:255'
        ],
        [
          'numero.required'=>str_replace('s$nombre$s','numero',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'id_punto.required'=>str_replace('s$nombre$s','punto de votación',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),

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
    return response()->json(view("lugar.mesa.crear")->with(["formulario"=>"I","urldespliegue"=>"listadesplieguepunto","idname"=>"id_punto"])->render());

  }
  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Punto de votacion
   */
  public function insertar(array $data)
  {


      $mesa=new MesasVotacion();
      $mesa->numero=$data['numero'];
      $mesa->id_punto=$data['id_punto'];
      $mesa->save();

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
          EvssaConstantes::MSJ=>"Se ha registrado correctamente la Mesa votación.",
          "html"=>response()->json(view("lugar.mesa.listar")->with(["urllistar"=>"mesa","urlgeneral"=>url("/"),"listadesplieguemesa"=>$this->cargarListaMesa()])->render())
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
    $mesa=MesasVotacion::find($id);
    return response()->json(view("lugar.mesa.crear")->with(["formulario"   =>"A",
                                                              'urldespliegue'=>'listadesplieguepunto',
                                                              'idname'=>'id_punto',
                                                              'mesa'=>$mesa,
                                                              'objeto'=>PuntosVotacion::find($mesa->id_punto)])->render());

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
        $this->actualizar(MesasVotacion::find($id),$request->all());
        return response()->json([
            EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
            EvssaConstantes::MSJ=>"Se ha actualizado correctamente la Mesa de votación.",
            "html"=>response()->json(view("lugar.mesa.listar")->with(["urllistar"=>"mesa","urlgeneral"=>url("/"),"listadesplieguemesa"=>$this->cargarListaMesa()])->render())
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
   * @return \App\
   */
  private function actualizar($mesa,array $data)
  {

      $mesa->numero=$data['numero'];
      $mesa->id_punto=$data['id_punto'];
      $mesa->save();
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
         MesasVotacion::find($id)->delete();
         return response()->json([
             EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
             EvssaConstantes::MSJ=>"Se ha eliminado correctamente el registro.",
             "html"=> response()->json(view("lugar.mesa.listar")->with(["urllistar"=>"mesa","urlgeneral"=>url("/"),"listadesplieguemesa"=>$this->cargarListaMesa()])->render())
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

  public function cargarDespliegueCombo(Request $request){

    $punto=new PuntosVotacion();

    return response()->json(view("combos.despliegue")->with(["lista"=>$punto->getListarPuntoDespliegue($request->buscar)])->render());
  }

  public function cargarDespliegueComboMesa(Request $request){

    $mesa=new MesasVotacion();

    return response()->json(view("combos.desplieguemesa")->with(["listamesa"=>$mesa->getListaMesa($request->buscar)])->render());
  }

  public function refrescar(Request $request){
    dd(Departamentos::join("ciudades","departamentos.id","ciudades.id_departamento")
                  ->join("puntos_votacions","ciudades.id","puntos_votacions.id_ciudad")
                  ->join("mesas_votacions","puntos_votacions.id","mesas_votacions.id_punto")
                  ->join("users","mesas_votacions.id","users.id_mesa")
                  ->orWhere("mesas_votacions.numero","like","".$request->buscar."%")
                  ->orWhere("puntos_votacions.direccion","like","%".$request->buscar."%")
                  ->orWhere("ciudades.nombre","like","%".$request->buscar."%")
                  ->orWhere("departamentos.nombre","like","%".$request->buscar."%")
                  ->orWhere(function ($query) use($request) {
                               $query->orWhere("users.name","LIKE","%".$request->buscar."%")
                                   ->orWhere("users.name2","LIKE","%".$request->buscar."%")
                                   ->orWhere("users.lastname","LIKE","%".$request->buscar."%")
                                   ->orWhere("users.lastname2","LIKE","%".$request->buscar."%");
                                 })
                  ->select("departamentos.nombre as departamento",
                           "ciudades.nombre as ciudad",
                           "puntos_votacions.direccion",
                           "mesas_votacions.numero",
                           "mesas_votacions.id",
                           "users.name",
                           "users.name2",
                           "users.lastname",
                           "users.lastname2")->toSql());

    return response()->json(view("lugar.mesa.tabla")->with(["urllistar"=>"mesa","urlgeneral"=>url("/"),"listadesplieguemesa"=>
              Departamentos::join("ciudades","departamentos.id","ciudades.id_departamento")
                            ->join("puntos_votacions","ciudades.id","puntos_votacions.id_ciudad")
                            ->join("mesas_votacions","puntos_votacions.id","mesas_votacions.id_punto")
                            ->join("users","mesas_votacions.id","users.id_mesa")
                            ->orWhere("mesas_votacions.numero","like","".$request->buscar."%")
                            ->orWhere("puntos_votacions.direccion","like","%".$request->buscar."%")
                            ->orWhere("ciudades.nombre","like","%".$request->buscar."%")
                            ->orWhere("departamentos.nombre","like","%".$request->buscar."%")
                            ->orWhere(function ($query) use($request) {
                                         $query->orWhere("users.name","LIKE","%".$request->buscar."%")
                                             ->orWhere("users.name2","LIKE","%".$request->buscar."%")
                                             ->orWhere("users.lastname","LIKE","%".$request->buscar."%")
                                             ->orWhere("users.lastname2","LIKE","%".$request->buscar."%");
                                           })
                            ->select("departamentos.nombre as departamento",
                                     "ciudades.nombre as ciudad",
                                     "puntos_votacions.direccion",
                                     "mesas_votacions.numero",
                                     "mesas_votacions.id",
                                     "users.name",
                                     "users.name2",
                                     "users.lastname",
                                     "users.lastname2")->paginate(10)])->render());
  }

  /**
  *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en pdf
  */
  public function oprimirPdf($buscar){

    $reemplazos=array(
    "buscar"=>$buscar==".c*"?"":str_replace(" ",".c*",$buscar)
    );
    $param=array("PR_STRSQL"=>Reporteador::resuelveConsulta("0001MESAGENERAL",$reemplazos));

    Reporteador::exportar("0001MESAGENERAL",EvssaConstantes::PDF,$param);


    // return redirect()->back();
  }

  /**
  *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en excel
  */
  public function oprimirExcel($buscar){
    $reemplazos=array(
    "buscar"=>$buscar==".c*"?"":str_replace(" ",".c*",$buscar)
    );
    $param=array("PR_STRSQL"=>Reporteador::resuelveConsulta("0001MESAGENERAL",$reemplazos));

    Reporteador::exportar("0001MESAGENERAL",EvssaConstantes::EXCEL,$param);

    // return redirect()->back();
  }
}
