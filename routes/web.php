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

Route::get('google','PuntoVotacionController@googleMaps');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/prueba', function () {
  $usuario=User::find(8);

  return view("layouts.cargando");
});
Route::get('reporte', 'UsuarioEController@oprimirExcel');

Route::get('/cselect', function () {
return view('maps.mapa');
});

Route::get('/select', function () {
  return view("auth.admin.form.formacionacademica");
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'super'],function(){

  Route::resource('usuario', 'UsuarioAController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);

  Route::resource('usuarioe', 'UsuarioEController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);

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

  //buscar Referido
  Route::get('listardiferidos', 'UsuarioEController@buscarReferido');

});
Route::group(['middleware'=>'admin'],function(){
    Route::get('form_crear_usuarioe', 'UsuarioEController@form_crear_usuarioe');
    Route::post('registrare', 'UsuarioEController@registrar')->name('registrare');
    Route::get('form_editar_usuarioe/{id}', 'UsuarioEController@form_editar_usuario');
    Route::resource('usuarioe', 'UsuarioEController');
    Route::get('form_informe_usurioe', 'InformePersonaE@form_informe_usurioe');

});
