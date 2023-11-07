<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\HoraAtencion;
use App\Models\Horario;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
class CitaController extends Controller
{
    public function index(){
        $citas = Cita::obtenerDatosCita();
        return view("cita.gestionCitas", ['citas' => $citas]);
    }
    public function registrarCita(){
        $medicos = User::where('cargo', 'Medico')->get();
        return view("cita.registrarCita",['medicos' => $medicos]);
    }
    public function store(Request $request){
        $request->validate([
            'motivo' => 'required',
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'hora_id' => 'required|exists:horasatencion,id',
        ]);
        $motivo = $request->input('motivo');
        $paciente_id = $request->input('paciente_id');
        $medico_id = $request->input('medico_id');
        $fecha = $request->input('fecha');
        $hora_id = $request->input('hora_id');
        Cita::crearCita($motivo, $paciente_id, $medico_id, $hora_id, $fecha);
        return redirect()->route('gestionCitas');
        }
    public function buscarPaciente(Request $request)
    {
        $dni = $request->input('dni_paciente');
        $paciente = Paciente::buscarPacientePorDni($dni);
        $medicos = User::where('cargo', 'Medico')->get();
        $horariosDisponibles = HoraAtencion::all();
        if ($paciente) {
            return view('cita.registrarCita')->with(['medicos' => $medicos,'paciente' => $paciente,'horariosDisponibles'=> $horariosDisponibles]);
        } else {
            return view('cita.registrarCita')->with(['medicos' => $medicos,'error' => 'No se encontraron resultados para el DNI: ' . $dni]);
        }
    }
    public function editarCita($id){
        return view('cita.editarCita')->with(['id'=> $id]);
    }
}
