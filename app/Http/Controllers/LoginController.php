<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view("user.login");
    }
    public function store(Request $request){
        $this->validate($request,[
            'dni'=>'required|numeric',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('dni','password'), $request->remember)){
            return back()->with('mensaje','Dni o contraseña incorrectos');
        }

        return redirect()->route('inicio');
    }
}
