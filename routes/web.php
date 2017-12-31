<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\User;
use App\Ciudades;
use App\Departamentos;
use App\Historialobservacion;
use App\Compania;
use App\Ano;
use App\Mes;
Route::resource('consultareporte','ConsultaController');

Route::get('/consulta', function () {
    return view('consulta');
});

Route::get('listadepartamentos','DepartamentoController@cargarListaCombo');

Route::get('listaciudades','CiudadController@cargarListaCombo');


Route::get('listadesplieguedepartamento','DepartamentoController@cargarDespliegueCombo');

Route::get('listadespliegueciudad','CiudadController@cargarDespliegueCombo');

Route::get('listadespliegueciudadfinal','CiudadController@cargarDespliegueComboFinal');

Route::get('listadesplieguemesa','MesaVotacionController@cargarDespliegueComboMesa');

Route::get('listadesplieguepuntofinal','PuntoVotacionController@cargarDespliegueComboFinal');

Route::get('listadesplieguepunto','MesaVotacionController@cargarDespliegueCombo');

Route::get('datosregistraduria','ConsultarInformacionElectoral@index');

Route::get('location','ConsultarInformacionElectoral@consultarCoordenadas');



Route::get('/', function () {
    $compania=Compania::find(1);
    $usuario=NULL;

      $usuario=new User();
      $usuario=$usuario->cantidadPotencialElectoralTodo();


    return view('welcome')->with([
      "general"=>$compania,
      "ano"=>Ano::find($compania->id_ano),
      "mes"=>Mes::find($compania->id_mes),
      "usuario"=>$usuario,
  ]);
});
Route::get('/prueba', function () {
  $usuario=User::find(8);

  return view("layouts.cargando");
});
Route::get('reporte', 'UsuarioEController@oprimirExcel');

Route::get('/cselect', function () {
return \DB::table('ciudades')->join("puntos_votacions","ciudades.id","puntos_votacions.id_ciudad")
                       ->join("mesas_votacions","puntos_votacions.id","mesas_votacions.id_punto")
                       ->join("users","mesas_votacions.id","users.id_mesa")
                       ->select(\DB::raw('COUNT(puntos_votacions.id) as contar, puntos_votacions.direccion,ciudades.nombre,users.name,users.name2,users.lastname,users.lastname2'))
                       ->groupBy('puntos_votacions.direccion','ciudades.nombre','users.name','users.name2','users.lastname','users.lastname2')
                       ->get();
});

Route::get('/otra',function(){

return Departamentos::join("ciudades","departamentos.id","ciudades.id_departamento")->select("ciudades.id","ciudades.nombre as ciudad","departamentos.nombre as departamento")->paginate(10);

});

Route::get('/select', function () {
  return view("auth.admin.form.formacionacademica");
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'super'],function(){
  Route::resource('usuario', 'UsuarioAController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);
  Route::resource('observation', 'HistorialObservacionController');
  Route::resource('departamento', 'DepartamentoController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);
  Route::resource('ciudad', 'CiudadController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);
  Route::resource('punto', 'PuntoVotacionController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);
  Route::resource('mesa', 'MesaVotacionController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);
  Route::resource('compania', 'CompaniaController',  ['only' => ['create', 'store', 'update', 'destroy','edit','index']]);
  Route::resource('ano', 'AnoController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);
  Route::resource('mes', 'MesController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);
  Route::get('listaano','AnoController@cargarListaAno');
  Route::get('listames','MesController@cargarListaMes');
});

Route::group(['middleware'=>'comun'],function(){
  Route::get('usuarioe/refrescar', 'UsuarioEController@refrescar');
  Route::get('usuario/refrescar', 'UsuarioAController@refrescar');
  Route::get('oprimirusuariogeneralpdf/{buscar}', 'UsuarioAController@oprimirPdf');
  Route::get('oprimirusuariogeneralexcel/{buscar}', 'UsuarioAController@oprimirExcel');

  Route::resource('usuario', 'UsuarioAController',  ['only' => ['index']]);
  Route::resource('usuarioe', 'UsuarioEController',  ['only' => ['index','create', 'store', 'update', 'destroy','edit']]);
  Route::get('oprimirusuarioegeneralpdf/{buscar}', 'UsuarioEController@oprimirPdf');
  Route::get('oprimirusuarioegeneralexcel/{buscar}', 'UsuarioEController@oprimirExcel');

  //Departamentos
  Route::resource('departamento', 'DepartamentoController',  ['only' => ['index']]);
  Route::get('departamento/refrescar','DepartamentoController@refrescar');
  Route::get('oprimirdepartamentogeneralpdf/{buscar}', 'DepartamentoController@oprimirPdf');
  Route::get('oprimirdepartamentogeneralexcel/{buscar}', 'DepartamentoController@oprimirExcel');

  //Ciudad
  Route::resource('ciudad','CiudadController',['only' => ['index']]);
  Route::get('ciudad/refrescar','CiudadController@refrescar');
  Route::get('oprimirciudadgeneralpdf/{buscar}', 'CiudadController@oprimirPdf');
  Route::get('oprimirciudadgeneralexcel/{buscar}', 'CiudadController@oprimirExcel');

  //punto de
  Route::resource('punto', 'PuntoVotacionController',  ['only' => ['index']]);
  Route::get('punto/refrescar','PuntoVotacionController@refrescar');
  Route::get('oprimirpuntogeneralpdf/{buscar}', 'PuntoVotacionController@oprimirPdf');
  Route::get('oprimirpuntogeneralexcel/{buscar}', 'PuntoVotacionController@oprimirExcel');
  //mesavotacion
  Route::resource('mesa', 'MesaVotacionController',  ['only' => ['index']]);
  Route::get('mesa/refrescar', 'MesaVotacionController@refrescar');
  Route::get('oprimirpdf/{buscar}', 'MesaVotacionController@oprimirPdf');
  Route::get('oprimirexcel/{buscar}', 'MesaVotacionController@oprimirExcel');


  //buscar Referido
  Route::get('listardiferidos', 'UsuarioEController@buscarReferido');
  Route::get('google','PuntoVotacionController@googleMaps');
  Route::get('potencial','UsuarioEController@mostrarpotencial');
  //ano
  Route::resource('ano', 'AnoController',  ['only' => ['index']]);
  Route::get('ano/refrescar','AnoController@refrescar');
  //mes
  Route::resource('mes', 'mesController',  ['only' => ['index']]);
  Route::get('mes/refrescar','MesController@refrescar');

});
Route::group(['middleware'=>'admin'],function(){

});
