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
class PuntoVotacionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    return response()->json(view("lugar.punto.listar")->with(["urllistar"=>"punto","urlgeneral"=>url("/"),"listapuntovotacion"=>PuntosVotacion::paginate(10)])->render());
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

      return response()->json(view("lugar.punto.crear")->with(["formulario"=>"I",'urldespliegue'=>'listadesplieguepunto','idname'=>'id_punto'])->render());
  }
  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Punto de votacion
   */
  public function insertar(array $data)
  {

    try {
      $punto=new PuntosVotacion();

      $punto->nombre=$data['nombre'];
      $punto->direccion=$data['direccion'];
      $punto->id_ciudad=$data['id_ciudad'];
      $punto->save();



    } catch (EvssaException $e) {
        EvssaUtil::agregarMensajeAlerta($e->getMensaje());
    }
    EvssaUtil::agregarMensajeConfirmacion("Se registro correctamente la ciudad");

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
          "html"=>redirect("punto")
      ]);
    } catch (EvssaException $e) {
        return response()->json([
            EvssaConstantes::NOTIFICACION=> EvssaConstantes::WARNING,
            EvssaConstantes::MSJ=>$e->getMensaje(),
        ]);
    } catch (\Illuminate\Database\QueryException $e) {
         return response()->json([
             EvssaConstantes::NOTIFICACION=> EvssaConstantes::WARNING,
             EvssaConstantes::MSJ=>"Registro secundario encontrado",
         ]);
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
            "html"=>redirect("punto")
        ]);
      } catch (EvssaException $e) {
          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::WARNING,
              EvssaConstantes::MSJ=>$e->getMensaje(),
          ]);
      } catch (\Illuminate\Database\QueryException $e) {
           return response()->json([
               EvssaConstantes::NOTIFICACION=> EvssaConstantes::WARNING,
               EvssaConstantes::MSJ=>"Registro secundario encontrado",
           ]);
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

    try {
      $punto->nombre=$data['nombre'];
      $punto->id_ciudad=$data['id_ciudad'];
      $punto->direccion=$data['direccion'];
      $punto->save();


    } catch (EvssaException $e) {
        EvssaUtil::agregarMensajeAlerta($e->getMensaje());
    }
    EvssaUtil::agregarMensajeConfirmacion("Se registro correctamente el punto de votacion");

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
             "html"=>redirect("punto")
         ]);
        } catch (EvssaException $e) {
            return response()->json([
                EvssaConstantes::NOTIFICACION=> EvssaConstantes::WARNING,
                EvssaConstantes::MSJ=>$e->getMensaje(),
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
             return response()->json([
                 EvssaConstantes::NOTIFICACION=> EvssaConstantes::WARNING,
                 EvssaConstantes::MSJ=>"Registro secundario encontrado",
             ]);
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
}
