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
    return view('welcome');
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

});

Route::group(['middleware'=>'comun'],function(){
  Route::get('usuarioe/refrescar', 'UsuarioEController@refrescar');
  Route::get('usuario/refrescar', 'UsuarioAController@refrescar');

  Route::resource('usuario', 'UsuarioAController',  ['only' => ['index']]);
  Route::resource('usuarioe', 'UsuarioEController',  ['only' => ['index','create', 'store', 'update', 'destroy','edit']]);

  //Departamentos
  Route::resource('departamento', 'DepartamentoController',  ['only' => ['index']]);
  Route::get('departamento/refrescar','DepartamentoController@refrescar');
  //Ciudad
  Route::resource('ciudad','CiudadController',['only' => ['index']]);
  Route::get('ciudad/refrescar','CiudadController@refrescar');
  //punto de
  Route::resource('punto', 'PuntoVotacionController',  ['only' => ['index']]);
  Route::get('punto/refrescar','PuntoVotacionController@refrescar');
  //mesavotacion
  Route::resource('mesa', 'MesaVotacionController',  ['only' => ['index']]);
  Route::get('mesa/refrescar', 'MesaVotacionController@refrescar');
  Route::get('oprimirpdf', 'MesaVotacionController@oprimirPdf');
  Route::get('oprimirexcel', 'MesaVotacionController@oprimirExcel');


  //buscar Referido
  Route::get('listardiferidos', 'UsuarioEController@buscarReferido');
  Route::get('google','PuntoVotacionController@googleMaps');
  Route::get('potencial','UsuarioEController@mostrarpotencial');
});
Route::group(['middleware'=>'admin'],function(){

});
