<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        if (auth()->check()) {
            return redirect('/inicio'); 
        }
        return view("user.login");
    }

    public function loginStore(Request $request){
        $this->validate($request,[
            'dni'=>'required|numeric',
            'password' => 'required'
        ]);
        if(!auth()->attempt($request->only('dni','password'), $request->remember)){
            return back()->with('mensaje','Dni o contraseña incorrectos');
        }

        return redirect()->route('inicio');
    }

    public function logoutStore(Request $request){
        auth()->logout();
        return redirect()->route("login");
    }
    
}
