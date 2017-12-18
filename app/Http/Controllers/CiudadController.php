<?php

namespace App\Http\Controllers;

use App\Ciudades;
use Illuminate\Http\Request;
use App\Evssa\EvssaPropertie;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaException;
use Illuminate\Support\Facades\Validator;
use App\Departamentos;


class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      return response()->json(view("lugar.ciudad.listar")->with(["urllistar"=>"ciudad","urlgeneral"=>url("/"),"listaciudades"=>Ciudades::paginate(10)])->render());
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
            'nombre' => 'required|string|max:255',
            'id_departamento' => 'required'],
          [
            'nombre.required'=>str_replace('s$nombre$s','nombre',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
            'id_departamento.required'=>str_replace('s$nombre$s','departamento',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE'))
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

        return response()->json(view("lugar.ciudad.crear")->with(["formulario"=>"I",'urldespliegue'=>'listadesplieguedepartamento','idname'=>'id_departamento'])->render());
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Ciudad
     */
    public function insertar(array $data)
    {


        $departamento=new Ciudades();
        $departamento->nombre=$data['nombre'];
        $departamento->id_departamento=$data['id_departamento'];
        $departamento->save();



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
            EvssaConstantes::MSJ=>"Se ha insertado correctamente la ciudad.",
            "html"=>response()->json(view("lugar.ciudad.listar")->with(["urllistar"=>"ciudad","urlgeneral"=>url("/"),"listaciudades"=>Ciudades::paginate(10)])->render())

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
      $ciudad=Ciudades::find($id);
      return response()->json(view("lugar.ciudad.crear")->with(["formulario"   =>"A",
                                                                'urldespliegue'=>'listadesplieguedepartamento',
                                                                'idname'=>'id_departamento',
                                                                'ciudad'=>$ciudad,
                                                                'objeto'=>Departamentos::find($ciudad->id_departamento)])->render());

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
          $this->actualizar(Ciudades::find($id),$request->all());
          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
              EvssaConstantes::MSJ=>"Se ha actualizado correctamente la Ciudad.",
              "html"=>response()->json(view("lugar.ciudad.listar")->with(["urllistar"=>"ciudad","urlgeneral"=>url("/"),"listaciudades"=>Ciudades::paginate(10)])->render())

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
    private function actualizar($ciudad,array $data)
    {

        $ciudad->nombre=$data['nombre'];
        $ciudad->id_departamento=$data['id_departamento'];
        $ciudad->save();


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
           Ciudades::find($id)->delete();
           return response()->json([
               EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
               EvssaConstantes::MSJ=>"Se ha eliminado correctamente el registro.",
               "html"=>redirect("departamento")
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

    public function cargarDespliegueComboFinal(Request $request){

      $ciudad=new Ciudades();
      return response()->json(view("combos.desplieguefinal")->with(["listafinal"=>$ciudad->getListarCiudadDespliegueFinal($request)])->render());
    }
/**
*refrescar la tabla
*/
    public function refrescar(Request $request){

      return response()->json(view("lugar.ciudad.tabla")->with(["urllistar"=>"ciudad","urlgeneral"=>url("/"),"listaciudades"=>Ciudades::where("nombre","like","%".$request->buscar."%")->paginate(10)])->render());
    }

}
