<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Compania;
use App\Ano;
class HomeController extends Controller
{
    private $usuario;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this -> usuario = new User ( );
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compania=Compania::find(1);
        $ano=Ano::find($compania->id_ano);
        return view('layouts.appadmin')->with(["compania"=>$compania,"ano"=>$ano]);
    }
}
