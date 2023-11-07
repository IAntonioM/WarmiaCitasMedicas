<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index(){
        $pacientes = Paciente::listarPacientes();
        return view("paciente.gestionPacientes", compact('pacientes'));
    }
    public function store(Request $request){
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|numeric|unique:pacientes',
            'fechaNacimiento' => 'required|date',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');
        $dni = $request->input('dni');
        $fechaNacimiento = $request->input('fechaNacimiento');
        $direccion = $request->input('direccion');
        $telefono = $request->input('telefono');

        Paciente::crearPaciente($nombres, $apellidos, $dni, $fechaNacimiento, $direccion, $telefono);

        return redirect()->route('gestionPacientes')->with('success','Se registro el usuario exitosamente');
        

    }

    public function obtenerPaciente($id)
    {
        $paciente = Paciente::find($id);
        return response()->json($paciente);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            // Agrega las validaciones para otros campos
        ]);

        $paciente = Paciente::find($id);
        $paciente->nombres = $request->input('nombres');
        // Actualiza otros campos aquí

        $paciente->save();

        return redirect()->route('paciente.index')->with('success', 'Paciente actualizado exitosamente.');
    }
}
