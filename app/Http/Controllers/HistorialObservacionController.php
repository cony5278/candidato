<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Evssa\EvssaPropertie;
use App\Evssa\EvssaConstantes;
use App\Evssa\EvssaUtil;
use App\Evssa\EvssaException;
use App\Historialobservacion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class HistorialObservacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
          'observacion' => 'required|string|max:255'],
        [
          'observacion.required'=>str_replace('s$nombre$s','observacion',EvssaPropertie::get('TB_OBLIGATORIO_MENSAJE')),
        ]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Ciudad
     */
    public function insertar(array $data)
    {

        $observacion=new Historialobservacion();
        $observacion->observacion=$data['observacion'];
        $observacion->id_user=$data['id_user'];
        $observacion->id_observador=Auth::user()->id;
        $observacion->save();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      try{

        $this->validator($request->all())->validate();
        $this->insertar($request->all());
        $usuario=User::find($request->id_user);

        $observacion=new Historialobservacion();
        $listaobservacion=$observacion->historialObservacion($usuario->id);

        return response()->json([
            EvssaConstantes::NOTIFICACION=> EvssaConstantes::SUCCESS,
            EvssaConstantes::MSJ=>"Se ha registrado correctamente la observación.",
            "html"=> response()->json(view("auth.observation.listar")->with(["usuario"=>$usuario,"urllistar"=>"usuarioe","listaobservacion"=>$listaobservacion])->render())

        ]);
      } catch (EvssaException $e) {
          return response()->json([
              EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
              EvssaConstantes::MSJ=>$e->getMensaje(),
          ],400);
      } catch (\Illuminate\Database\QueryException $e) {
           return response()->json([
               EvssaConstantes::NOTIFICACION=> EvssaConstantes::DANGER,
               EvssaConstantes::MSJ=>"Registro secundario encontrado",
           ],400);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $usuario=User::find($id);
            $observacion=new Historialobservacion();
          return view("auth.observation.listar")->with(["usuario"=>$usuario,"urllistar"=>"usuarioe","listaobservacion"=>$observacion->historialObservacion($id)]);
      }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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
