<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    private $suario;



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
        $user=\Auth::user();
        return view('layouts.appadmin')->with(['usuarioAdmin'=> $this -> usuario->getAllUsuarioAdmin($user->type=='S'?'A':'E')]);
    }
}
