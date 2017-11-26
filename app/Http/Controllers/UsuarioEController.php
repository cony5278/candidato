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
class UsuarioEController extends Controller
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
        return 'hola';

    }

    public function registrar(Request $request)
    {

        //$this->validator($request->all())->validate();
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


        $usuario=new User();

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
        $usuario->type= $data['type']=='S'?'A':'E';
        $usuario->telefonofijo=empty($data['fijo'])?null:$data['fijo'];
        $usuario->telefonomovil=empty($data['movil'])?null:$data['movil'];
        $usuario->sex=empty($data['sexo'])?null:$data['sexo'];
        $usuario->address=empty($data['direccionusuario'])?null:$data['direccionusuario'];

        if (!empty($data['photo'])) {
            $archivo = new Archivos ($data['photo']);
            $usuario->photo = $archivo -> getArchivoNombreExtension();
        }
        $puntoVotacion=new PuntosVotacion();
        $puntoVotacion=$puntoVotacion->buscar($data['direccionvotacion'],$data['id_ciudad']);

        $mesa=new MesasVotacion();
        $mesa=$mesa->buscar($data['mesavotacion'],$puntoVotacion);
        $usuario->id_mesa=$mesa->id;

        $opciones=new Opcion();
        $opciones->buscar($data);
        if(!empty($opciones)){
          $usuario->id_opcions=$opciones->id;
        }
        if(!empty($data['empresa']) && !empty($data['cargo'])){
          $empresa=new Empresa();
          $empresa->buscar($data);
          $usuario->id_empresa=$empresa->id;
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
    public function form_crear_usuarioe(){

        return view("auth.admin.creare")->with(self::url());
    }

    public function form_editar_usuario($id){

        $usuario=User::find($id);
        $usuario=$usuario->getUsuarioAll();
        return view("auth.admin.creare")->with("usuario",$usuario)->with(self::url());
    }
}
