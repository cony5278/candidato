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

Route::get('/', function () {
    return view('welcome')->with(["todo"]);
});
Route::get('listadepartamentos','DepartamentoController@index');

Route::get('listaciudades','CiudadController@index');

Route::get('datosregistraduria','ConsultarInformacionElectoral@index');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/select', function () {
    return view('layouts.copiaapp');
});
Auth::routes();

Route::group(['middleware'=>'admin'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('registrar', 'RegistrarUsuarioController@registrar')->name('registrar');
    Route::resource('usuario', 'RegistrarUsuarioController');
    Route::get('form_editar_usuario/{id}', 'RegistrarUsuarioController@form_editar_usuario');
    Route::get('form_crear_usuario', 'RegistrarUsuarioController@form_crear_usuario');
    Route::get('form_listar_usuario', 'RegistrarUsuarioController@form_listar_usuario');

   // Route::get('form_crear_usuario/{id}', '');
   // Route::post('/registrarpersona','RegistrarUsuarioController@register')->name('registrarpersona');

});

Route::group(['middleware'=>'usuarioestandar'],function(){
    Route::get('form_crear_usuarioe', 'UsuarioEController@form_crear_usuarioe');
    Route::post('registrare', 'UsuarioEController@registrar')->name('registrare');

});