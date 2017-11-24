<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAllUsuarioAdmin($tipo){
        return $this->where("type",$tipo)->paginate(2);
    }
    public function getAllUsuarioTodo(){
        return $this->paginate(2);
    }
    public function actualizar(Request $request, $id){
        $registro=$this->where('id', '=', $id)->first();
        $registro->name=$request->name;
        $registro->name2=$request->name2;
        $registro->lastname=$request->lastname;
        $registro->lastname2=$request->lastname2;
        $registro->password=$request->password;
        $registro->email=$request->email;
        $registro->save();
    }
    public function getUsuarioTipo($id){
       return $this->where('id', '=', $id)->where('type','=',\Auth::user()->type=='S'?'A':'E')->first();
    }
}
