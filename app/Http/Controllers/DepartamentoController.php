<?php

namespace App\Http\Controllers;

use App\Departamentos;
use Illuminate\Http\Request;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaException;
use Illuminate\Support\Facades\Validator;
use App\Evssa\EvssaPropertie;
use App\Reporteador;

class DepartamentoController extends Controller
{
      protected $redirectTo = '/home';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      return response()->json(view("lugar.departamento.listar")->with(["urllistar"=>"departamento","urlgeneral"=>url("/"),"listadepartamentos"=>Departamentos::paginate(10)])->render());
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
            'nombre' => 'required|string|max:255'
          ],
           [
            'nombre.required'=>str_replace('s$nombre$s','nombre',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          ]
      );

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

        return response()->json(view("lugar.departamento.crear")->with(["formulario"=>"I"])->render());
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Departamento
     */
    public function insertar(array $data)
    {

        $departamento=new Departamentos();
        $departamento->nombre=$data['nombre'];
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
            EvssaConstantes::MSJ=>"Se ha insertado correctamente el departamento.",
            "html"=>response()->json(view("lugar.departamento.listar")->with(["urllistar"=>"departamento","urlgeneral"=>url("/"),"listadepartamentos"=>Departamentos::paginate(10)])->render())
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

        return response()->json(view("lugar.departamento.crear")->with(["formulario"=>"A","departamento"=>Departamentos::find($id)])->render());

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
          $this->actualizar(Departamentos::find($id),$request->all());
          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
              EvssaConstantes::MSJ=>"Se ha actualizado correctamente el departamento.",
              "html"=>response()->json(view("lugar.departamento.listar")->with(["urllistar"=>"departamento","urlgeneral"=>url("/"),"listadepartamentos"=>Departamentos::paginate(10)])->render())

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
    private function actualizar($departamento,array $data)
    {

        $departamento->nombre=$data['nombre'];
        $departamento->save();


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
           Departamentos::find($id)->delete();
           // dd(redirect("departamento"));
           // return redirect("departamento");
           return response()->json([
               EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
               EvssaConstantes::MSJ=>"Se ha eliminado correctamente el registro.",
               "html"=> response()->json(view("lugar.departamento.listar")->with(["urllistar"=>"departamento","urlgeneral"=>url("/"),"listadepartamentos"=>Departamentos::paginate(10)])->render())

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
    *lista todos los departamentos
    */
    public function cargarListaDepartamento(){

      return view("lugar.listar")->with(["listadepartamentos"=>Departamentos::all()]);
    }

    public function cargarListaCombo(Request $request)
    {

        if($request->ajax()){

            return response()->json($this->buscar("combos.grande",$request->buscar)->render());
        }else{
            return $this->buscar('combos.grande',$request->buscar);
        }
    }

    private function buscar($vista,$buscar)
    {
        $departmanetos=new Departamentos();

        return view($vista)->with([
            "departamentos"=>$departmanetos->getListarDepartamentos($buscar),
            "entrada"=>"entrada-departamento",
            "entradaid"=>"entrada-departamento-id"
        ]);
    }

    public function cargarDespliegueCombo(Request $request){

      $departamentos=new Departamentos();

      return response()->json(view("combos.despliegue")->with(["lista"=>$departamentos->getListarDepartamentosDespliegue($request->buscar)])->render());
    }


    /**
    *refrescar la tabla
    */
        public function refrescar(Request $request){

          return response()->json(view("lugar.departamento.tabla")->with(["urllistar"=>"departamento","urlgeneral"=>url("/"),"listadepartamentos"=>
          Departamentos::where("nombre","like","%".$request->buscar."%")->paginate(10)])->render());
      }

      /**
      *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en pdf
      */
      public function oprimirPdf($buscar){

        $reemplazos=array(
            "buscar"=>$buscar==".c*"?"":str_replace(" ",".c*",$buscar)
        );
        $param=array("PR_STRSQL"=>Reporteador::resuelveConsulta("0003DEPARTAMENTOS",$reemplazos));

        Reporteador::exportar("0003DEPARTAMENTOS",EvssaConstantes::PDF,$param);
      }

      /**
      *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en excel
      */
      public function oprimirExcel($buscar){
        $reemplazos=array(
              "buscar"=>$buscar==".c*"?"":str_replace(" ",".c*",$buscar)
        );
        $param=array("PR_STRSQL"=>Reporteador::resuelveConsulta("0003DEPARTAMENTOS",$reemplazos));

        Reporteador::exportar("0003DEPARTAMENTOS",EvssaConstantes::EXCEL,$param);
      }
}
