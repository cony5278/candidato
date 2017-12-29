<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ano;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaException;
use Illuminate\Support\Facades\Validator;
use App\Evssa\EvssaPropertie;

class AnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(view("periodo.ano.listar")->with(["urllistar"=>"ano","urlgeneral"=>url("/"),"listaano"=>Ano::paginate(10)])->render());

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
            'numero' => 'required|numeric'
          ],
           [
            'numero.required'=>str_replace('s$nombre$s','numero',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
            'numero.numeric'=>str_replace('s$nombre$s','numero',EvssaPropertie::get('TB_NUMERICO')),
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
      return response()->json(view("periodo.ano.crear")->with(["formulario"=>"I"])->render());

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
            EvssaConstantes::MSJ=>"Se ha registrado correctamente el ano.",
            "html"=>response()->json(view("periodo.ano.listar")->with(["urllistar"=>"ano","urlgeneral"=>url("/"),"listaano"=>Ano::paginate(10)])->render())
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
        $ano=new Ano();
        $ano->numero=$data['numero'];
        $ano->save();
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
      return response()->json(view("periodo.ano.crear")->with(["formulario"=>"A","ano"=>Ano::find($id)])->render());
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
        $this->actualizar(Ano::find($id),$request->all());
        return response()->json([
            EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
            EvssaConstantes::MSJ=>str_replace('s$tabla$s','el ano',EvssaPropertie::get('TB_ACTUALIZAR')),
            "html"=>response()->json(view("periodo.ano.listar")->with(["urllistar"=>"ano","urlgeneral"=>url("/"),"listaano"=>Ano::paginate(10)])->render())

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
    private function actualizar($ano,array $data)
    {

        $ano->numero=$data['numero'];
        $ano->save();


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
        Ano::find($id)->delete();
        // dd(redirect("departamento"));
        // return redirect("departamento");
        return response()->json([
            EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
            EvssaConstantes::MSJ=>EvssaPropertie::get('TB_ELIMINAR'),
            "html"=>response()->json(view("periodo.ano.listar")->with(["urllistar"=>"ano","urlgeneral"=>url("/"),"listaano"=>Ano::paginate(10)])->render())

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

        return response()->json(view("periodo.ano.tabla")->with(["urllistar"=>"ano","urlgeneral"=>url("/"),"listaano"=>Ano::where("numero","like","".$request->buscar."%")->paginate(10)])->render());
    }

    public function cargarListaAno(Request $request){
      $ano=new Ano();
      return response()->json(view("combos.despliegueano")->with(["listaano"=>Ano::where("numero","like","".$request->buscar."%")->get()])->render());

    }
}
