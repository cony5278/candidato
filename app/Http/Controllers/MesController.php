<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mes;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaException;
use Illuminate\Support\Facades\Validator;
use App\Evssa\EvssaPropertie;
class MesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return response()->json(view("periodo.mes.listar")->with(["urllistar"=>"mes","urlgeneral"=>url("/"),"listames"=>Mes::paginate(10)])->render());

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
          'nombre' => 'required|max:15'
        ],
         [
          'nombre.required'=>str_replace('s$nombre$s','nombre',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
            ]
    );

  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return response()->json(view("periodo.mes.crear")->with(["formulario"=>"I"])->render());

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
          EvssaConstantes::MSJ=>str_replace('s$tabla$s','el mes',EvssaPropertie::get('TB_INSERTAR')),
          "html"=>response()->json(view("periodo.mes.listar")->with(["urllistar"=>"mes","urlgeneral"=>url("/"),"listames"=>Mes::paginate(10)])->render())
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
   * @return \App\Ano
   */
  public function insertar(array $data)
  {
      $mes=new Mes();
      $mes->nombre=$data['nombre'];
      $mes->save();
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
    return response()->json(view("periodo.mes.crear")->with(["formulario"=>"A","mes"=>Mes::find($id)])->render());
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
      $this->actualizar(Mes::find($id),$request->all());
      return response()->json([
          EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
          EvssaConstantes::MSJ=>str_replace('s$tabla$s','el mes',EvssaPropertie::get('TB_ACTUALIZAR')),
          "html"=>response()->json(view("periodo.mes.listar")->with(["urllistar"=>"mes","urlgeneral"=>url("/"),"listames"=>Mes::paginate(10)])->render())

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
   * @return \App\Departamento
   */
  private function actualizar($mes,array $data)
  {

      $mes->nombre=$data['nombre'];
      $mes->save();


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
      Mes::find($id)->delete();
      // dd(redirect("departamento"));
      // return redirect("departamento");
      return response()->json([
          EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
          EvssaConstantes::MSJ=>EvssaPropertie::get('TB_ELIMINAR'),
          "html"=>response()->json(view("periodo.mes.listar")->with(["urllistar"=>"mes","urlgeneral"=>url("/"),"listames"=>Mes::paginate(10)])->render())

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
  *refrescar la tabla
  */
      public function refrescar(Request $request){

        return response()->json(view("periodo.mes.tabla")->with(["urllistar"=>"mes","urlgeneral"=>url("/"),"listames"=>Mes::where("nombre","like","%".$request->buscar."%")->paginate(10)])->render());
    }

    public function cargarListaMes(Request $request){
      $mes=new Mes();
      return response()->json(view("combos.desplieguemes")->with(["listames"=>Mes::where("nombre","like","".$request->buscar."%")->get()])->render());

    }
}
