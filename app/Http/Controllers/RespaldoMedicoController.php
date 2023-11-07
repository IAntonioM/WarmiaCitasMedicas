<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RespaldoMedicoController extends Controller
{
    public function index(){
        return view("respaldoMedico.gestionRespaldoMedico");
    }
    public function registrarRespaldoMedico(){
        return view("respaldoMedico.registrarRespaldoMedico");
    }
}
