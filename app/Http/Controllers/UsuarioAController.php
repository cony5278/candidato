<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Archivos;
use Carbon\Carbon;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaException;
use App\Evssa\EvssaPropertie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Reporteador;
class UsuarioAController extends Controller
{

  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $usuario=new User();
      $listar=$this->cargarListaPersona();
      $listar->setPath(url("home"));
      return response()->json(view('auth.admin.listar')->with(['listarusuario'=>$listar,'type'=>'A','urllistar'=>'usuario',"urlgeneral"=>url("/"),'urlreportepdfgeneral'=>'oprimirusuariogeneralpdf','urlreporteexcelgeneral'=>'oprimirusuariogeneralexcel'])->render());
    }

    private function cargarListaPersona(){
        $usuario=new User();
      return $usuario->getAllUsuarioAdmin('A');
    }

    public function registrar(Request $request)
    {

      try{

        $this->validator($request->all())->validate();
        if (!empty($request->file('photo'))) {
          $this->validatePhoto($request->all())->validate();
        }

        $this->insertar(new User(),$request);

        $listar=$this->cargarListaPersona();
        return response()->json([
            EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
            EvssaConstantes::MSJ=>"Se ha registrado correctamente el administrador.",
            "html"=> response()->json(view('auth.admin.listar')->with(['listarusuario'=>$listar,'type'=>'A','urllistar'=>'usuario',"urlgeneral"=>url("/"),'urlreportepdfgeneral'=>'oprimirusuariogeneralpdf','urlreporteexcelgeneral'=>'oprimirusuariogeneralexcel'])->render())
              ]);
      } catch (EvssaException $e) {
          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
              EvssaConstantes::MSJ=>$e->getMensaje(),
          ]);
      } catch (\Illuminate\Database\QueryException $e) {
           return response()->json([
               EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
               EvssaConstantes::MSJ=>"Registro secundario encontrado",
           ]);
      }

    }

    /**
     * Get a validator for an incoming registration request.NoRewindIterator
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'type' => 'required',
            'password' => 'required|string|min:6|confirmed',

        ],
        [
          'nombre.required'=>str_replace('s$nombre$s','nombre',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'apellido.required'=>str_replace('s$nombre$s','nombre',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'email.required'=>str_replace('s$nombre$s','Correo Electronico',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
          'email.unique'=>EvssaPropertie::get('TB_EMAIL_UNICO'),
          'type.required'=>str_replace('s$nombre$s','Tipo De Usuario',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),

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
      return view("auth.admin.crear")->with(["formulario"=>"I",
                                      "type"=>"A",
                                      'idnamereferido'=>'id_referido',
                                      'urlreferido'=>'listardiferidos'])->with(self::url());
     }

    private function insertar($usuario,Request $request){
      $data=$request->all();

      $usuario->nit = $data['nit'];
      $usuario->name = $data['nombre'];
      $usuario->name2 = $data['nombre2'];
      $usuario->lastname = $data['apellido'];
      $usuario->lastname2 = $data['apellido2'];
      // $usuario->password => bcrypt($data['password']);
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
      //si tiene referido
      if(!empty($data['id_referido'])){
        $usuario->id_referido=$data['id_referido'];
      }
      //crear foto
      if (!empty($request->file('photo'))) {

          $archivo = new Archivos ($request->file('photo'));
          $usuario->photo = $archivo -> getArchivoNombreExtension();
      }
      if(!empty($data['password'])){
        $usuario->password= bcrypt($data['password']);
      }

      $usuario->save();
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
       return $this->registrar($request);
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

      $usuario=User::find($id);
      $formacions=$usuario->formacionacademica()->get();
      $vista=Auth::user()->id!=$usuario->id?"auth.admin.crear":"auth.admin.modal";
        return view($vista)->with([
        "formulario"=>"A",
        "usuario"=>$usuario,
        "type"=>"A",
        "referido"=>User::find($usuario->id_referido),
        'idnamereferido'=>'id_referido',
        'urlreferido'=>'listardiferidos',
        ])->with(self::url());

    }

    public function changue_password(Request $request, $id){

    }
    public function validatorUpdate(array $data)
    {
      return Validator::make($data, [
          'nombre' => 'required|string|max:255',
          'apellido' => 'required|string|max:255',
          'type' => 'required',
      ],
      [
        'nombre.required'=>str_replace('s$nombre$s','nombre',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
        'apellido.required'=>str_replace('s$nombre$s','nombre',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
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
        $this->validatorUpdate($request->all())->validate();
        if (!empty($request->file('photo'))) {
          $this->validatePhoto($request->all())->validate();
        }
        $usuario=$this->actualizar($usuario,$request);

            if($request->ajax()) {
                $listar=$this->cargarListaPersona();
                $listar->setPath(url("home"));
                  return response()->json([
                      EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
                      EvssaConstantes::MSJ=>"Se ha actualizado correctamente el usuario.",
                      "html"=>response()->json(view('auth.admin.listar')->with(['listarusuario'=>$listar,'type'=>'A','urllistar'=>'usuario',"urlgeneral"=>url("/"),'urlreportepdfgeneral'=>'oprimirusuariogeneralpdf','urlreporteexcelgeneral'=>'oprimirusuariogeneralexcel'])->render())

                  ]);
            }else{
              Session::flash(EvssaConstantes::NOTIFICACION,EvssaConstantes::SUCCESS);
              Session::flash(EvssaConstantes::MSJ,"Se ha actualizado correctamente el usuario.");

              return redirect()->back();
            }
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
      //crear foto
      $data=$request->all();

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
      $this->cambiarcontrasena($usuario,$request);
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
          User::find($id)->delete();
          $usuario=new User();
          $listar=$usuario->getAllUsuarioAdmin('A');
          $listar->setPath(url("home"));

            return response()->json([
                EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
                EvssaConstantes::MSJ=>"Se ha eliminado correctamente el usuario.",
                "html"=>response()->json(view('auth.admin.listar')->with(['listarusuario'=>$listar,'type'=>'A','urllistar'=>'usuario',"urlgeneral"=>url("/"),'urlreportepdfgeneral'=>'oprimirusuariogeneralpdf','urlreporteexcelgeneral'=>'oprimirusuariogeneralexcel'])->render())

            ]);


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

    public function form_crear_usuario(){
        return view("auth.admin.crear")->with(["formulario"=>"I","type"=>"A"])->with(self::url());
    }
    public static function  url(){
        return [
            'urldatosregistraduria'=>url("/datosregistraduria"),
           ];
    }

    public function refrescar(Request $request){

      $usuario=new User();

      $listar=$usuario->getAllUsuarioRefresh($request,'A');
      return response()->json(view('auth.admin.tabla')->with(['listarusuario'=>$listar,'type'=>'A','urllistar'=>'usuario',"urlgeneral"=>url("/"),'urlreportepdfgeneral'=>'oprimirusuariogeneralpdf','urlreporteexcelgeneral'=>'oprimirusuariogeneralexcel'])->render());
    }
    public function cambiarcontrasena($usuario,Request $request){
      if(!empty($request->passwordold)&&!empty($request->password)&&!empty($request->password_confirmation)){
        if(Hash::check($request->passwordold,$usuario->password)  && $request->password == $request->password_confirmation){
            $usuario->password= bcrypt($request->password);
        }
      }
    }

    /**
    *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en pdf
    */
    public function oprimirPdf($buscar){

      $reemplazos=array(
        "buscar"=>$buscar==".c*"?"":str_replace(" ",".c*",$buscar)
      );
      $param=array("PR_STRSQL"=>Reporteador::resuelveConsulta("0006ADMINISTRADOR",$reemplazos));

      Reporteador::exportar("0006ADMINISTRADOR",EvssaConstantes::PDF,$param);
    }

    /**
    *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en excel
    */
    public function oprimirExcel($buscar){
      $reemplazos=array(
        "buscar"=>$buscar==".c*"?"":str_replace(" ",".c*",$buscar)
      );
      $param=array("PR_STRSQL"=>Reporteador::resuelveConsulta("0006ADMINISTRADOR",$reemplazos));

      Reporteador::exportar("0006ADMINISTRADOR",EvssaConstantes::EXCEL,$param);
    }
}
