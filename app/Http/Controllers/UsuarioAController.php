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
      return response()->json(view('auth.admin.listar')->with(['listarusuario'=>$listar,'type'=>'A','urllistar'=>'usuario',"urlgeneral"=>url("/")])->render());
    }

    private function cargarListaPersona(){
        $usuario=new User();
      return $usuario->getAllUsuarioAdmin('A');
    }

    public function registrar(Request $request)
    {
      try{

        $this->validator($request->all())->validate();
        $this->insertar(new User(),$request);

        $listar=$this->cargarListaPersona();
        return response()->json([
            EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
            EvssaConstantes::MSJ=>"Se ha registrado correctamente el administrador.",
            "html"=> response()->json(view('auth.admin.listar')->with(['listarusuario'=>$listar,'type'=>'A','urllistar'=>'usuario',"urlgeneral"=>url("/")])->render())
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

      return view("auth.admin.crear")->with([
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
        ]);
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
        $usuario=$this->actualizar($usuario,$request);

        $listar=$this->cargarListaPersona();
        $listar->setPath(url("home"));
          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
              EvssaConstantes::MSJ=>"Se ha actualizado correctamente el usuario.",
              "html"=>response()->json(view('auth.admin.listar')->with(['listarusuario'=>$listar,'type'=>'A','urllistar'=>'usuario',"urlgeneral"=>url("/")])->render())

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

        User::find($id)->delete();
        $user=\Auth::user();
        $listar=$this -> usuario->getAllUsuarioAdmin($user->type=='S'?'A':'E');
        $listar->setPath(url("home"));
        return view('auth.admin.listar')->with(['usuarioAdmin'=>$listar,'type'=>'A']);
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
      return response()->json(view('auth.admin.tabla')->with(['listarusuario'=>$listar,'type'=>'A','urllistar'=>'usuario',"urlgeneral"=>url("/")])->render());
    }

}
