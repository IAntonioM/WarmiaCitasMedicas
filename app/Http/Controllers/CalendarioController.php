<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function index(){
        return view("cita.calendarioCitas");
    }
    public function indexmedico(){
        return view("cita.calendarioMedico");
    }
    public function store(Request $request){
        
        $title = $request->input('title');
        $descripcion = $request->input('descripcion');
        $color = $request->input('color');
        $hora = $request->input('hora');
        $start = $request->input('start') . " " . $hora;
        $end = $request->input('end') . " " . $hora;
        Evento::crearEvento($title, $descripcion, $start, $end, $color);
    }
    public function show(Request $request){
        $eventos = Evento::all();
        return response()->json($eventos);
        
    }
    
}
