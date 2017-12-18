<?php

namespace App\Http\Controllers;

use App\PuntosVotacion;
use App\MesasVotacion;
use Illuminate\Http\Request;
use App\Evssa\EvssaPropertie;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaException;
use Illuminate\Support\Facades\Validator;

class MesaVotacionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    return response()->json(view("lugar.mesa.listar")->with(["urllistar"=>"mesa","urlgeneral"=>url("/"),"listadesplieguemesa"=>MesasVotacion::paginate(10)])->render());
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
          "html"=>response()->json(view("lugar.mesa.listar")->with(["urllistar"=>"mesa","urlgeneral"=>url("/"),"listadesplieguemesa"=>MesasVotacion::paginate(10)])->render())
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
            "html"=>response()->json(view("lugar.mesa.listar")->with(["urllistar"=>"mesa","urlgeneral"=>url("/"),"listadesplieguemesa"=>MesasVotacion::paginate(10)])->render())
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

  public function cargarDespliegueCombo(Request $request){

    $punto=new PuntosVotacion();

    return response()->json(view("combos.despliegue")->with(["lista"=>$punto->getListarPuntoDespliegue($request->buscar)])->render());
  }

  public function cargarDespliegueComboMesa(Request $request){

    $mesa=new MesasVotacion();

    return response()->json(view("combos.desplieguemesa")->with(["listamesa"=>$mesa->getListaMesa($request->buscar)])->render());
  }

  public function refrescar(Request $request){

    return response()->json(view("lugar.mesa.tabla")->with(["urllistar"=>"mesa","urlgeneral"=>url("/"),"listadesplieguemesa"=>MesasVotacion::where("numero","like","".$request->buscar."%")->paginate(10)])->render());
  }
}
