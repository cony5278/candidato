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
use App\EvssaConstantes;
use App\Reporteador;
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
      // dd($request->all());
        Session::flash("seccion","II");
        $this->validator($request->all())->validate();
        Session::forget('seccion');
        Session::forget('seccionid');
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
     * validacion de la insercion de cualquier usuario
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {

        return Validator::make($data, [
            'nombre'            => 'required|string|min:2',
            'apellido'          => 'required|string|min:2',
            'mesavotacion'      => 'required|string|max:255',
            'direccionvotacion' => 'required|string|max:255',
            'ciudad'            => 'required|string',
            'departamento'      => 'required|string',
            'type'              => 'required',
            'email'             => 'required|string|email|max:255|unique:users',
        ]);

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
            'mesavotacion'      => 'required|string|max:255',
            'direccionvotacion' => 'required|string|max:255',
            'ciudad'            => 'required|string',
            'departamento'      => 'required|string',
            'type'              => 'required',
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
      //tabla punto de votacion
      $puntoVotacion=new PuntosVotacion();
      $puntoVotacion=$puntoVotacion->buscar($data['direccionvotacion'],$data['id_ciudad']);
      //tabla mesa de votacion
      $mesa=new MesasVotacion();
      $mesa=$mesa->buscar($data['mesavotacion'],$puntoVotacion);
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
      // dd($request->all());
      //buscar usuario
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
        if(empty($data['id_departamento'])){
         $departamento=Departamentos::find($data['id_departamento']);
        }else{
         $departamento=new Departamentos();
        }
        $departamento->nombre=empty($data['departamento'])?null:$data['departamento'];
        $departamento->save();

        //tabla departamneto
        if(!empty($data['id_ciudad'])){
         $ciudad=Ciudades::find($data['id_ciudad']);
        }else{
         $ciudad=new Ciudades();
        }
        $ciudad->nombre=empty($data['ciudad'])?null:$data['ciudad'];
        $ciudad->id_departamento=$departamento->id;
        $ciudad->save();

        //tabla punto de votacion
        if(!empty($data['direccionvotacion'])){
          $puntosvotacion=PuntosVotacion::where("direccion","=",empty($data['direccionvotacion'])?null:$data['direccionvotacion'])
                                          ->where("id_ciudad","=",$ciudad->id)->first();
          if(empty($puntosvotacion)){
            $puntosvotacion=new PuntosVotacion();
            $puntosvotacion->direccion=empty($data['direccionvotacion'])?null:$data['direccionvotacion'];
            $puntosvotacion->id_ciudad=$ciudad->id;
          }
        }else{
          $puntosvotacion=new PuntosVotacion();
        }
        $puntosvotacion->direccion=empty($data['direccionvotacion'])?null:$data['direccionvotacion'];
        $puntosvotacion->id_ciudad=$ciudad->id;
        $puntosvotacion->save();

        //tabla mesa de MesasVotacion
        if(!empty($data['id_mesa'])){
          $mesa=MesasVotacion::find($data['id_mesa']);
        }else{
          $mesa=new MesasVotacion();
        }
        $mesa->numero=empty($data['mesavotacion'])?null:$data['mesavotacion'];
        $mesa->id_punto=$puntosvotacion->id;
        $mesa->save();
        $usuario->id_mesa=$mesa->id;
        //tabla usuario
        $usuario->type=$data['type'];
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

        return view("auth.admin.creare")->with(["formulario"=>"I"])->with(self::url());
    }
    public function form_editar_usuario($id){

        $usuario=User::find($id);
        $formacions=$usuario->formacionacademica()->get();

        return view("auth.admin.creare")->with([
          "formulario"=>"A",
          "usuario"=>$usuario,
          "formacions"=>$formacions,
          "opcion"=>$usuario->opcion(),
          "empresa"=>$usuario->empresas(),
          "mesavotacion"=>$usuario->mesa(),
          ])->with(self::url());
    }
    /**
    *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en pdf
    */
    public function oprimirPdf(){
      Reporteador::exportar("personal",EvssaConstantes::PDF);
    }

    /**
    *metodo que al oprimir el boton pdf se descarga el listado de personas o reporte en excel
    */
    public function oprimirExcel(){
      Reporteador::exportar("personal",EvssaConstantes::XLSX);
    }

}
