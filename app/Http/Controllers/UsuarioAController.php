<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Archivos;
use Carbon\Carbon;

class UsuarioAController extends Controller
{
    protected $redirectTo = '/home';
    private $suario;



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
        //
    }

    public function registrar(Request $request)
    {

        $this->validator($request->all())->validate();
        $this->create($request->all());
        return  redirect($this->redirectPath());

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
     * Get a validator for an incoming registration request.
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
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(array $data)
    {

      $usuario=$this->insertar(new User(),$data);
      Session::flash("notificacion","SUCCESS");
      Session::flash("msj","Usuario creado. ");
      return $usuario;


    }

    private function insertar($usuario,array $data){

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

      if (!empty($data['photo'])) {
          $archivo = new Archivos ($data['photo']);
          $usuario->photo = $archivo -> getArchivoNombreExtension();
      }
      $usuario->save();
      if (!empty($data['photo'])) {
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
        //
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

      $usuario=User::find($id);
      //crear variable de sesion por si las cosas salen mal
      Session::flash("seccion","A");
      Session::flash("seccionid",$usuario->id);
      $this->validatorUpdate($request->all())->validate();
      //eliminar variables si toda va bien
      Session::forget('seccion');
      Session::forget('seccionid');

      $usuario=$this->actualizar($usuario,$request->all());
      Session::flash("notificacion","SUCCESS");
      Session::flash("msj","Los datos del usuario se actualizaron correctamente. ");
      return  redirect($this->redirectPath());
    }

    private function actualizar($usuario,array $data){

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

        if (!empty($data['photo'])) {
            $archivo = new Archivos ($data['photo']);
            $usuario->photo = $archivo -> getArchivoNombreExtension();
        }
        if (!empty($data['photo'])) {
            $archivo->guardarArchivo($usuario);
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
    public function form_listar_usuario(){
        $user=\Auth::user();
        $listar=$this -> usuario->getAllUsuarioAdmin('A');
        $listar->setPath(url("home"));
        return view('auth.admin.listar')->with(['usuarioAdmin'=>$listar,'type'=>'A']);
    }
    public function form_editar_usuario($id){
      $usuario=User::find($id);
      $formacions=$usuario->formacionacademica()->get();

      return view("auth.admin.crear")->with([
        "formulario"=>"A",
        "usuario"=>$usuario,
        "type"=>"A",
        ])->with(self::url());
    }
}
