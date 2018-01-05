<?php

namespace App\Http\Controllers;

use App\Areaconocimiento;
use App\MesasVotacion;
use App\Nivelacademico;
use App\Otro;
use App\Poblacion;
use App\PuntosVotacion;
use App\Socioeconomica;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Archivos;
use Carbon\Carbon;
use App\Opcion;
use App\Empresa;
use App\Formacionacademica;
use App\Departamentos;
use App\Ciudades;
use App\Reporteador;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaException;
use App\Evssa\EvssaPropertie;

class UsuarioEController extends Controller
{
    protected $redirectTo = '/home';
    private $usuario;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this -> usuario = new User ( );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user=\Auth::user();
      $listar=$this -> usuario->getAllUsuarioAdmin('E');
      $listar->setPath(url("home"));
      return response()->json(view('auth.admin.listar')->with(['listarusuario'=>$listar,'type'=>'E','urllistar'=>'usuarioe',"urlgeneral"=>url("/"),'urlreportepdfgeneral'=>'oprimirusuarioegeneralpdf','urlreporteexcelgeneral'=>'oprimirusuarioegeneralexcel'])->render());

    }


    /**
     * Get a validator for an incoming registration request.
     * validacion de la insercion de cualquier usuario
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {

        return Validator::make($data, [
            'nombre'            => 'required|string|min:2',
            'apellido'          => 'required|string|min:2',
            'id_mesa'           => 'required|string|max:255',
            'id_punto'          => 'required|string|max:255',
            'id_ciudad'         => 'required|string',
            'id_departamento'   => 'required|string',
            'type'              => 'required',
            'email'             => 'required|string|email|max:255|unique:users',

        ],
        [
          'nombre.required'=>str_replace('s$nombre$s','Nombre',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'apellido.required'=>str_replace('s$nombre$s','Apellido',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'id_mesa.required'=>str_replace('s$nombre$s','Mesa votación',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'id_punto.required'=>str_replace('s$nombre$s','Punto De Votación',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'id_departamento.required'=>str_replace('s$nombre$s','Departamento',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'type.required'=>str_replace('s$nombre$s','Tipo De Usuario',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'email.required'=>str_replace('s$nombre$s','Correo Electronico',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'email.unique'=>EvssaPropertie::get('TB_EMAIL_UNICO'),

        ]
      );

    }

    /**
     * Get a validator for an incoming registration request.
     * validacion de la insercion de cualquier usuario
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validatorUpdate(array $data)
    {

        return Validator::make($data, [
            'nombre'            => 'required|string|min:2',
            'apellido'          => 'required|string|min:2',
            'id_mesa'           => 'required|string|max:255',
            'id_punto'          => 'required|string|max:255',
            'id_ciudad'         => 'required|string',
            'id_departamento'   => 'required|string',
            'type'              => 'required',
        ],
        [
          'nombre.required'=>str_replace('s$nombre$s','Nombre',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'apellido.required'=>str_replace('s$nombre$s','Apellido',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'id_mesa.required'=>str_replace('s$nombre$s','Mesa votación',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'id_punto.required'=>str_replace('s$nombre$s','Punto De Votación',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'id_departamento.required'=>str_replace('s$nombre$s','Departamento',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'type.required'=>str_replace('s$nombre$s','Tipo De Usuario',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
              ]
      );

    }


    private function validatePhoto(array $data){
          return Validator::make($data, [
              'photo' =>'mimes:jpeg,jpg,png,gif'
            ],
             [
                'photo.mimes'=>EvssaPropertie::get('TB_FORMATO'),
            ]
            );
        }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create()
    {

        return view("auth.admin.creare")->with(["formulario"=>"I",
                                                "type"=>"E",
                                                "urlpunto"=>"listadesplieguepuntofinal",
                                                "urlmesa"=>"listadesplieguemesa",
                                                "urldesplieguefinal"=>"listadespliegueciudadfinal",
                                                'urldesplieguedepartamento'=>'listadesplieguedepartamento',
                                                "idnamefinal"=>"id_ciudad",
                                                'idname'=>'id_departamento',
                                                'idnamepunto'=>'id_punto',
                                                'idnamemesa'=>'id_mesa',
                                                'idnamereferido'=>'id_referido',
                                                'urlreferido'=>'listardiferidos'  ])->with(self::url());
    }

    private function insertar($usuario,Request $request){

      $data=$request->all();
      $usuario->nit = $data['nit'];
      $usuario->name = $data['nombre'];
      $usuario->name2 = $data['nombre2'];
      $usuario->lastname = $data['apellido'];
      $usuario->lastname2 = $data['apellido2'];
      if(!empty($data['fechanacimiento'])) {
          $usuario->birthdate = Carbon::createFromFormat('d/m/Y',
              $data['fechanacimiento']);
      }
      $usuario->email= $data['email'];
      $usuario->type= $data['type'];
      $usuario->telefonofijo=empty($data['fijo'])?null:$data['fijo'];
      $usuario->telefonomovil=empty($data['movil'])?null:$data['movil'];
      $usuario->sex=empty($data['sexo'])?null:$data['sexo'];
      $usuario->address=empty($data['direccionusuario'])?null:$data['direccionusuario'];

      if (!empty($request->file('photo'))) {

          $archivo = new Archivos ($request->file('photo'));
          $usuario->photo = $archivo -> getArchivoNombreExtension();
      }

      //tabla punto de votacion

      $puntoVotacion=PuntosVotacion::find($data['id_punto']);
      //tabla mesa de votacion
      $mesa=MesasVotacion::find($data['id_mesa']);
      $usuario->id_mesa=$mesa->id;
      //tabla opcion
      $opciones=new Opcion();
      $opciones->buscar($data);
      if(!empty($opciones)){
        $usuario->id_opcions=$opciones->id;
      }
      //tabla empresa
      if(!empty($data['empresa']) && !empty($data['cargo'])){
        $empresa=new Empresa();
        $empresa->buscar($data);
        $usuario->id_empresa=$empresa->id;
        }
        //si tiene referido
      if(!empty($data['id_referido'])){
        $usuario->id_referido=$data['id_referido'];
      }
      //si tiene una cantidad de potencial electoral
      if(!empty($data['potencial'])){
        $usuario->potencial=$data['potencial'];
      }

      $usuario->save();

      if(!empty($data['idforomacionacademica'])){

            for($i = 0; $i < count($data['idforomacionacademica']); ++$i) {
        //    foreach ($data['idforomacionacademica'] as $idformacion and $data['descripcionacademica'] as $descripcion) {
                $formacionacademica=new Formacionacademica();
                $formacionacademica->user_id=$usuario->id;
                $formacionacademica->id_nivelacademicos=$data['idforomacionacademica'][$i];
                $formacionacademica->descripcion=empty($data['descripcionacademica'][$i])?null:$data['descripcionacademica'][$i];
                $formacionacademica->save();
              }
      }
      if (!empty($request->file('photo'))) {
          $archivo->guardarArchivo($usuario);
      }
      return $usuario;
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
        if (!empty($request->file('photo'))) {
          $this->validatePhoto($request->all())->validate();
        }

        $this->insertar(new User(),$request);

        $usuario=new User();
        $listar=$usuario->getAllUsuarioAdmin('E');
        $listar->setPath(url("home"));

        return response()->json([
            EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
            EvssaConstantes::MSJ=>"Se ha registrado correctamente el usuario.",
            "html"=> response()->json(view('auth.admin.listar')->with(['listarusuario'=>$listar,'type'=>'E','urllistar'=>'usuarioe',"urlgeneral"=>url("/"),'urlreportepdfgeneral'=>'oprimirusuarioegeneralpdf','urlreporteexcelgeneral'=>'oprimirusuarioegeneralexcel'])->render())
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
        //

                $usuario=User::find($id);
                $formacions=$usuario->formacionacademica()->get();
                $mesa=MesasVotacion::find($usuario->id_mesa);
                $punto=PuntosVotacion::find($mesa->id_punto);
                $ciudad=Ciudades::find($punto->id_ciudad);
                return view("auth.admin.creare")->with([
                  "formulario"=>"A",
                  "usuario"=>$usuario,
                  "formacions"=>$formacions,
                  "opcion"=>$usuario->opcion(),
                  "empresa"=>$usuario->empresas(),
                  "mesa"=>$mesa,
                  "punto"=>$punto,
                  "departamento"=>Departamentos::find($ciudad->id_departamento),
                  "ciudad"=>$ciudad,
                  "type"=>"E",
                  "referido"=>User::find($usuario->id_referido),
                  "urlpunto"=>"listadesplieguepuntofinal",
                  "urlmesa"=>"listadesplieguemesa",
                  "urldesplieguefinal"=>"listadespliegueciudadfinal",
                  'urldesplieguedepartamento'=>'listadesplieguedepartamento',
                  "idnamefinal"=>"id_ciudad",
                  'idname'=>'id_departamento',
                  'idnamepunto'=>'id_punto',
                  'idnamemesa'=>'id_mesa',
                  'idnamereferido'=>'id_referido',
                  'urlreferido'=>'listardiferidos',
                  ])->with(self::url());

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


      try{

        $usuario=User::find($id);
        //crear variable de sesion por si las cosas salen mal
        $this->validatorUpdate($request->all())->validate();
        if (!empty($request->file('photo'))) {
          $this->validatePhoto($request->all())->validate();
        }
        $usuario=$this->actualizar($usuario,$request);
        $usuario=new User();
        $listar=$usuario->getAllUsuarioAdmin('E');
        $listar->setPath(url("home"));

          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
              EvssaConstantes::MSJ=>"Se ha actualizado correctamente el usuario.",
              "html"=>response()->json(view('auth.admin.listar')->with(['listarusuario'=>$listar,'type'=>'E','urllistar'=>'usuarioe',"urlgeneral"=>url("/"),'urlreportepdfgeneral'=>'oprimirusuarioegeneralpdf','urlreporteexcelgeneral'=>'oprimirusuarioegeneralexcel'])->render())

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
    private function actualizar($usuario,Request $request){
      $data=$request->all();
      //tabla opcion
      if(!empty($usuario->id_opcions)){
        $opcion=Opcion::find($usuario->id_opcions);
      }else{
        $opcion=new Opcion();
      }
      $opcion->id_socioeconomica=empty($data['condicionsocial'])?null:$data['condicionsocial'];
      $opcion->id_poblacions=empty($data['poblacion'])?null:$data['poblacion'];
      $opcion->id_areaconocimientos=empty($data['area'])?null:$data['area'];
      $opcion->id_otros=empty($data['otro'])?null:$data['otro'];
      $opcion->save();
      $usuario->id_opcions=$opcion->id;
      //tabla formacion academica
      $formacion=new Formacionacademica();
      $formacion->eliminar($usuario,$data);
      if(!empty($data['idforomacionacademica'])){
            for($i = 0; $i < count($data['idforomacionacademica']); ++$i) {
                if(!empty($data['idforomacionacademica'][$i])){
                      $formacionacademica=Formacionacademica::find($data['idforomacionacademica'][$i]);
                      if(!empty($formacionacademica)){
                        //actualizacion
                        $formacionacademica->id_nivelacademicos=empty($data['idprofesion'][$i])?null:$data['idprofesion'][$i];
                      }else{
                        //insercion
                        $formacionacademica=new Formacionacademica();
                        $formacionacademica->id_nivelacademicos=$data['idforomacionacademica'][$i];
                       }
                       $formacionacademica->user_id=$usuario->id;
                       $formacionacademica->descripcion=empty($data['descripcionacademica'][$i])?null:$data['descripcionacademica'][$i];
                       $formacionacademica->save();
                  }
              }
        }
        //tabla departamneto
        if(!empty($data['id_departamento'])){
         $departamento=Departamentos::find($data['id_departamento']);
        }

        //tabla departamneto
        if(!empty($data['id_ciudad'])){
         $ciudad=Ciudades::find($data['id_ciudad']);
         $ciudad->id_departamento=$departamento->id;
         $ciudad->save();
        }


        //tabla punto de votacion
        if(!empty($data['id_punto'])){
          $puntosvotacion=PuntosVotacion::find($data['id_punto']);
          $puntosvotacion->id_ciudad=$ciudad->id;
          $puntosvotacion->save();
        }


        //tabla mesa de MesasVotacion
        if(!empty($data['id_mesa'])){
          $mesa=MesasVotacion::find($data['id_mesa']);
          $mesa->id_punto=$puntosvotacion->id;
          $mesa->save();
        }
        $usuario->id_mesa=$mesa->id;
        //tabla usuario
        $usuario->type= $data['type'];
        $usuario->nit=$data['nit'];
        $usuario->name=$data['nombre'];
        $usuario->name2=$data['nombre2'];
        $usuario->lastname=$data['apellido'];
        $usuario->lastname2=$data['apellido2'];
        $usuario->email=$data['email'];
        if(!empty($data['fechanacimiento'])) {
            $usuario->birthdate = Carbon::createFromFormat('d/m/Y',
                $data['fechanacimiento']);
        }
        $usuario->telefonomovil=$data['movil'];
        $usuario->telefonofijo=$data['fijo'];
        $usuario->sex=$data['sexo'];
        $usuario->address=$data['direccionusuario'];
        //tabla empresa
        if(!empty($data['id_empresa'])){
          $empresa=Empresa::find($data['id_empresa']);
          $empresa->nombre=empty($data['empresa'])?null:$data['empresa'];
          $empresa->cargo=empty($data['cargo'])?null:$data['cargo'];
          $empresa->save();
        }else{
          if(!empty($data['empresa']) && !empty($data['cargo'])){
            $empresa=new Empresa();
            $empresa->buscar($data);
            $usuario->id_empresa=$empresa->id;
            }
        }
        $usuario->id_empresa=empty($empresa->id)?null:$empresa->id;

        if (!empty($request->file('photo'))) {

            $archivo = new Archivos ($request->file('photo'));
            $usuario->photo = $archivo -> getArchivoNombreExtension();
        }
        if (!empty($request->file('photo'))) {
            $archivo->guardarArchivo($usuario);
        }
        //si tiene referido
        if(!empty($data['id_referido'])){
          $usuario->id_referido=$data['id_referido'];
        }
        //si tiene una cantidad de potencial electoral
        if(!empty($data['potencial'])){
          $usuario->potencial=$data['potencial'];
        }
        $usuario->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      try{
        $usuario=User::find($id);
        if($usuario->formacionacademica()->delete() >= 0){

          if(\DB::table("historialobservacions")->where("id_user","=",$usuario->id)->delete() >= 0){

              $usuario->delete();
              $usuario=new User();
              $listar=$usuario->getAllUsuarioAdmin('E');

                return response()->json([
                    EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
                    EvssaConstantes::MSJ=>"Se ha eliminado correctamente el usuario.",
                    "html"=>response()->json(view('auth.admin.listar')->with(['listarusuario'=>$listar,'type'=>'E','urllistar'=>'usuarioe',"urlgeneral"=>url("/"),'urlreportepdfgeneral'=>'oprimirusuarioegeneralpdf','urlreporteexcelgeneral'=>'oprimirusuarioegeneralexcel'])->render())

                ]);
          }else{
            return response()->json([
                EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
                EvssaConstantes::MSJ=>"Error al eliminar el usuario, registro secundario encontrado",
            ],400);
          }
        }else{
          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
              EvssaConstantes::MSJ=>"Error al eliminar el usuario, registro secundario encontrado",
          ],400);
        }


      } catch (EvssaException $e) {
          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
              EvssaConstantes::MSJ=>$e->getMensaje(),
          ],400);
      } catch (\Illuminate\Database\QueryException $e) {
           return response()->json([
               EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
               EvssaConstantes::MSJ=>"Error al eliminar el usuario, registro secundario encontrado",
           ],400);
      }
    }
    public static function  url(){
        return [
            'urldepartamento'=>url("/listadepartamentos"),
            'urlciudades'=>url("/listaciudades"),
            'urldatosregistraduria'=>url("/datosregistraduria"),
            'condicionsocioeconomicas'=>SocioEconomica::all(),
            'poblaciones'=>Poblacion::all(),
            'areasconocimiento'=>Areaconocimiento::all(),
            'otros'=>Otro::all(),
            'nivelacademico'=>Nivelacademico::all(),

        ];
    }

    public function form_editar_usuario($id){

    }




    public function listarpaginationtable(Request $request){

          if($request->ajax()){
              $user=\Auth::user();
              $listar=$this -> usuario->getAllUsuarioAdmin($request->type);
              $listar->setPath(url("home"));
              return response()->json(view('auth.admin.listar')->with(['usuarioAdmin'=>$listar,'type'=>$request->type,'urlreportepdfgeneral'=>'oprimirusuarioegeneralpdf','urlreporteexcelgeneral'=>'oprimirusuarioegeneralexcel'])->render());
          }
    }

    public function buscarReferido(Request $request){
      if(!empty($request->id)){
          return response()->json(view("combos.desplieguediferido")
                      ->with(["listausuario"=> User::where(function ($query) use($request) {
                                   $query->orWhere("NAME","LIKE","%".$request->buscar."%")
                                       ->orWhere("NAME2","LIKE","%".$request->buscar."%")
                                       ->orWhere("LASTNAME","LIKE","%".$request->buscar."%")
                                       ->orWhere("LASTNAME2","LIKE","%".$request->buscar."%");
                               })->where("id","<>",$request->id)->get()])->render());
         }
         return response()->json(view("combos.desplieguediferido")
                         ->with(["listausuario"=> User::orWhere("NAME","LIKE","%".$request->buscar."%")
                                          ->orWhere("NAME2","LIKE","%".$request->buscar."%")
                                          ->orWhere("LASTNAME","LIKE","%".$request->buscar."%")
                                          ->orWhere("LASTNAME2","LIKE","%".$request->buscar."%")
                                          ->get()])->render());


    }

    public function refrescar(Request $request){
      $usuario=new User();
      $listar=$usuario->getAllUsuarioRefresh($request,'E');

      return response()->json(view('auth.admin.tabla')->with(['listarusuario'=>$listar,'type'=>'E','urllistar'=>'usuarioe',"urlgeneral"=>url("/"),'urlreportepdfgeneral'=>'oprimirusuarioegeneralpdf','urlreporteexcelgeneral'=>'oprimirusuarioegeneralexcel'])->render());
    }

    public function mostrarpotencial(Request $request){
        $usuario=new User();
        $usuario=$usuario->cantidadPotencialElectoral($request);
        return response()->json(view('cuerpotencial')->with(['usuario'=>$usuario,'potencial'=>User::find($request->id_referido)->potencial])->render());
    }
    /**
    *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en pdf
    */
    public function oprimirPdf($buscar){

      $reemplazos=array(
        "buscar"=>$buscar==".c*"?"":str_replace(" ",".c*",$buscar)
      );
      $param=array("PR_STRSQL"=>Reporteador::resuelveConsulta("0007VOTANTE",$reemplazos));

      Reporteador::exportar("0007VOTANTE",EvssaConstantes::PDF,$param);
    }

    /**
    *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en excel
    */
    public function oprimirExcel($buscar){
      $reemplazos=array(
        "buscar"=>$buscar==".c*"?"":str_replace(" ",".c*",$buscar)
      );
      $param=array("PR_STRSQL"=>Reporteador::resuelveConsulta("0007VOTANTE",$reemplazos));

      Reporteador::exportar("0007VOTANTE",EvssaConstantes::EXCEL,$param);
    }
}
