<?php

namespace App\Http\Controllers;

use App\ArrayList;
use App\Ciudades;
use App\Departamentos;
use App\PuntosVotacion;
use App\MesasVotacion;
use Illuminate\Http\Request;
use Goutte\Client;
use function Sodium\add;

class ConsultarInformacionElectoral extends Controller
{
    private $lista;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->lista=new ArrayList();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //

        $client = new Client();

        /**
         * metodo que me trae la direccion de votacion lugar mesa en la pagina de la registraduria
         */
        $this->registraduriaMesa($request,$client);
        /**
         * metodo que extrae los nombre y apellidos de las personas
         */
        $this->sisbenNombre($request,$client);

            if($request->ajax()) {

                $nombres=explode(' ', $this->lista->item(9));
                $apellidos=explode(' ', $this->lista->item(10));
                //dd($this->lista->getArray());

                if($request->type=='E'){

                $departamento=new Departamentos();
                $departamento=$departamento->buscar($this->lista->item(0));

                $ciudad=new Ciudades();
                $ciudad=$ciudad->buscar($this->lista->item(1),$departamento);

                $punto=new PuntosVotacion();
                $punto=$punto->getBuscarDireccion($this->lista->item(3),$ciudad);

                $mesa=new MesasVotacion();
                $mesa=$mesa->buscar($this->lista->item(5),$punto);
                return response()->json(view("auth.admin.creare")->with([
                    "formulario"=>$request->acme,
                    "nit"=>$request->cedula,
                    "departamento"=>$departamento,
                    "ciudad"=>$ciudad,
                    "nombre"=>$this->lista->item(2),
                    "punto"=>$punto,
                    "mesa"=>$mesa,
                    "nombre1"=>$nombres[0],
                    "nombre2"=>$nombres[1],
                    "apellido1"=>$apellidos[0],
                    "apellido2"=>$apellidos[1],
                    "type"=>$request->type,
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
                ])->with(UsuarioEController::url())->render());
              }else{
                return response()->json(view("auth.admin.crear")->with([
                    "formulario"=>$request->acme,
                    "nit"=>$request->cedula,
                    "nombre1"=>$nombres[0],
                    "nombre2"=>$nombres[1],
                    "apellido1"=>$apellidos[0],
                    "apellido2"=>$apellidos[1],
                    "type"=>$request->type,
                    'urlreferido'=>'listardiferidos',
                    'idnamereferido'=>'id_referido',
                    'urlreferido'=>'listardiferidos',
                ])->with(UsuarioEController::url())->render());
              }
            }
    }
    private function registraduriaMesa(Request $request,$client){

        $crawler = $client->request('GET', 'https://wsp.registraduria.gov.co/censo/_censoResultado.php?nCedula='.$request->cedula.'&nCedulaH=&x=91&y=14');
        $configurationRows = $crawler->filter('tr');
        $configurationRows->each(function($configurationRow, $index) {

            $this->lista->addItem($configurationRow->filter('td')->eq(1)->text());
        });


    }

    private function sisbenNombre(Request $request,$cliente){
        $vista  =$cliente->request("POST","https://wssisbenconsulta.sisben.gov.co/DNP_SisbenConsulta/DNP_SISBEN_Consulta.aspx");

        $formulario=$vista->selectButton("Consultar")->form();
        //dd($formulario->all());
        $vista=$cliente->submit($formulario, array(
              'ddlTipoDocumento' => '1',
              'tboxNumeroDocumento'=>$request->cedula,
        ));

        $vista->filter('span')->each(function ($node){
            $this->lista->addItem($node->text());
        });

    }
    public function consultarCoordenadas(){
        $client = new Client();
        $this->googleLocation($client);
    }
    private function googleLocation($cliente){


    }    /**
     * Show the form for creating a nephp artisan ser
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
