<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\HistoriaClinica;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;

class HistoriasClinicasController extends Controller
{
    public function __construct(){
    $this->middleware("auth");
}
public function index() {
    // Obtener historias clínicas paginadas
    $historiasClinicas = HistoriaClinica::with(['cita.medico', 'paciente'])
        ->orderBy('created_at', 'desc')
        ->paginate(7);

    return view("historialClinico.Historiaclinica", ['historiasClinicas' => $historiasClinicas]);
}
    public function salaDeEspera(Request $request){
        $busqueda = $request->busqueda;
        $user = auth()->user();
        $id = $user->id;
        $busqueda=$request->busqueda;
        $medico = Medico::where('user_id', $id)->first();

        $medicos = Medico::obtenerMedicos();
        $citas = Cita::obtenerCitaPorEstado("Confirmada",$medico->id);
        return view("historialClinico.salaDeEspera", ['citas' => $citas,'medicos' => $medicos,'busqueda'=>$busqueda]);
    }
    public function indexRegistrar($idPaciente, $idCita){
        $paciente=Paciente::buscarPacientePorDni($idPaciente);
        $cita = Cita::obtenerCitasPorId($idCita);
        return view("historialClinico.registrarHistoriaClinica", ['paciente' => $paciente,'cita' => $cita]);
    }

    public function store(Request $request){
        $user = auth()->user();
        $id = $user->id;
        $medico = Medico::where('user_id', $id)->first();
        
        $archivoRespaldo = $request->file('archivo_respaldo');
        $rutaArchivo = $archivoRespaldo->storeAs('archivos_historias', $archivoRespaldo->getClientOriginalName(), 'public');

        $historiaClinica = new HistoriaClinica;
        $historiaClinica->paciente_id = $request->paciente_id;
        $historiaClinica->medico_id = $medico->id;
        $historiaClinica->cita_id = $request->cita_id;
        $historiaClinica->titulo = $request->titulo;
        $historiaClinica->diagnostico = $request->diagnostico;
        $historiaClinica->archivo_adjunto_path = $rutaArchivo;
        $historiaClinica->tipo = $request->tipo;
        $historiaClinica->save();

        return redirect()->route('historialClinico');
    }
    public function put(Request $request){
        return view("historialClinico.gestionHistoriaclinica");
    }
    public function delete(Request $request){
        return view("historialClinico.gestionHistoriaclinica");
    }
}
