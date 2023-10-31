<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrarCitaController extends Controller
{
    public function index(){
        return view("cita.registrarCita");
    }
}
