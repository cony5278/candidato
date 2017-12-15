<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Archivos;


class RegistrarUsuarioController extends Controller
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
        dd("crear usuario admin");
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        dd("crear usuario admin");
        $usuario=new User();


        $usuario->name = $data['name'];
        $usuario->email= $data['email'];
        $usuario->password = bcrypt($data['password']);
        $usuario->type= $data['type']=='S'?'A':'E';
        if (!empty($data['photo'])) {
            $archivo = new Archivos ($data['photo']);
            $usuario->photo = $archivo -> getArchivoNombreExtension();
        }
        $usuario->save();
        if (!empty($data['photo'])) {
            $archivo->guardarArchivo($usuario);
        }
        Session::flash("notificacion","SUCCESS");
        Session::flash("msj","Usuario creado. ");
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
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

        $this->validatorUpdate($request->all())->validate();

        $usuario = $this->usuario->getUsuarioTipo($id);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if (!empty($request->photo)) {
            $archivo = new Archivos ($request->photo);
            $archivo -> guardarArchivo ($usuario );
            $usuario->photo = $archivo->getArchivoNombreExtension();
        }
        $usuario->save();

        return  redirect($this->redirectPath())->withInput()->with(["notificacion"=>"SUCCESS","msj"=>"Se cambiaron los datos correctamente."]);
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
        return view('auth.admin.listar')->with(['usuarioAdmin'=>$listar]);
    }

    public function form_crear_usuario(){
        return view("auth.admin.crear")->with(["formulario"=>"I"])->with(self::url());
    }
    public static function  url(){
        return [
            'urldatosregistraduria'=>url("/datosregistraduria"),
           ];
    }
    public function form_listar_usuario(){
        $user=\Auth::user();
        $listar=$this -> usuario->getAllUsuarioAdmin($user->type=='S'?'A':'E');
        $listar->setPath(url("home"));
        return view('auth.admin.listar')->with(['usuarioAdmin'=>$listar]);
    }
    public function form_editar_usuario($id){
        $usuario=$this->usuario->getUsuarioTipo($id);

        return view("auth.admin.actualizar")->with("usuario",$usuario);
    }
}
