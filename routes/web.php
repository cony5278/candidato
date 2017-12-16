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
Route::resource('consultareporte','ConsultaController');

Route::get('/consulta', function () {
    return view('consulta');
});

Route::get('listadepartamentos','DepartamentoController@cargarListaCombo');

Route::get('listaciudades','CiudadController@cargarListaCombo');


Route::get('listadesplieguedepartamento','DepartamentoController@cargarDespliegueCombo');

Route::get('listadespliegueciudad','CiudadController@cargarDespliegueCombo');

Route::get('listadesplieguepunto','MesaVotacionController@cargarDespliegueCombo');

Route::get('datosregistraduria','ConsultarInformacionElectoral@index');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/prueba', function () {
  $usuario=User::find(8);

  return view("layouts.cargando");
});
Route::get('reporte', 'UsuarioEController@oprimirExcel');


Route::get('/select', function () {
  return view("auth.admin.form.formacionacademica");
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'super'],function(){

  Route::get('form_crear_usuario', 'UsuarioAController@form_crear_usuario');
  Route::post('registrar', 'UsuarioAController@registrar')->name('registrar');
  Route::get('form_editar_usuario/{id}', 'UsuarioAController@form_editar_usuario');
  Route::resource('usuario', 'UsuarioAController');
  Route::get('form_informe_usurio', 'UsuarioAController@form_informe_usurio');
  Route::resource('departamento', 'DepartamentoController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);
  Route::resource('ciudad', 'CiudadController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);
  Route::resource('punto', 'PuntoVotacionController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);
  Route::resource('mesa', 'MesaVotacionController',  ['only' => ['create', 'store', 'update', 'destroy','edit']]);

});

Route::group(['middleware'=>'comun'],function(){
  Route::get('form_listar_usuario', 'UsuarioAController@form_listar_usuario');
  Route::get('form_listar_usuarioe', 'UsuarioEController@form_listar_usuario');
  Route::get('listarpaginationtable', 'UsuarioEController@listarpaginationtable');
  //Departamentos
  Route::resource('departamento', 'DepartamentoController',  ['only' => ['index']]);
  //Ciudad
  Route::resource('ciudad','CiudadController',['only' => ['index']]);
  //punto de
  Route::resource('punto', 'PuntoVotacionController',  ['only' => ['index']]);
  //mesavotacion
  Route::resource('mesa', 'MesaVotacionController',  ['only' => ['index']]);


});
Route::group(['middleware'=>'admin'],function(){
    Route::get('form_crear_usuarioe', 'UsuarioEController@form_crear_usuarioe');
    Route::post('registrare', 'UsuarioEController@registrar')->name('registrare');
    Route::get('form_editar_usuarioe/{id}', 'UsuarioEController@form_editar_usuario');
    Route::resource('usuarioe', 'UsuarioEController');
    Route::get('form_informe_usurioe', 'InformePersonaE@form_informe_usurioe');

});
