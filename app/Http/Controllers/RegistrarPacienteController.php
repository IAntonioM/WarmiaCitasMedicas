<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrarPacienteController extends Controller
{
    public function index(){
        return view("paciente.registrarPaciente");
    }
}
