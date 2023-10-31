<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
class CrearUsuarioController extends Controller
{
    public function index(){
        return view("user.crearUsuario");
    }
    public function store(Request $request){
        $this->validate($request,[
            'nombres'=>'required',
            'apellidos'=>'required',
            'dni'=>'required|numeric|digits:8',
            'password' => [
                'required',
                'confirmed',
                'min:8', // Cambiamos la longitud mínima a 8 caracteres
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]+$/' // Requiere al menos una mayúscula, una minúscula, un número y un carácter especial
            ]
        ]);

        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');
        $dni = $request->input('dni');
        $password = bcrypt($request->input('password'));

        User::crearUsuario($nombres,$apellidos,$dni,$password);

        
    
    }
}
