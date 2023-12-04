<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\HistoriaClinica;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class HistoriasClinicasController extends Controller
{
    public function __construct(){
    $this->middleware("auth");
}
public function index(Request $request) {
    // Obtener historias clínicas paginadas
    $historiasClinicas = HistoriaClinica::with(['cita.medico', 'paciente'])
        ->orderBy('created_at', 'desc')
        ->paginate(7);

    return view("historialClinico.Historiasclinicas", ['historiasClinicas' => $historiasClinicas]);
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
        $historiasClinicas = HistoriaClinica::where('paciente_id', $idPaciente)
            ->orderBy('created_at', 'desc')
            ->get();
        $paciente=Paciente::buscarPacientePorDni($idPaciente);
        $cita = Cita::obtenerCitasPorId($idCita);
        return view("historialClinico.registrarHistoriaClinica", ['paciente' => $paciente,'cita' => $cita,'historiasClinicas'=>$historiasClinicas]);
    }

    public function store(Request $request){
        $user = auth()->user();
        $id = $user->id;
        $medico = Medico::where('user_id', $id)->first();
        $validator = Validator::make($request->all(), [
            'archivo_respaldo' => 'required|file|mimes:pdf|max:2048',
            'paciente_id' => 'required|exists:pacientes,id',
            'cita_id' => 'required|exists:citas,id',
            'titulo' => 'required|string|max:255',
            'diagnostico' => 'required|string',
            'tipo' => ['required', Rule::in(['Inicial', 'Control'])],
        ]);
        $validator->stopOnFirstFailure(); 
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Error al registrar historia clinica. Verifica los campos e inténtalo de nuevo.')->with('type', 'error');
        }
        $archivoRespaldo = $request->file('archivo_respaldo');
        $uuid = Str::uuid();
        $nombreArchivo = "{$uuid}_";
        $rutaArchivo = $archivoRespaldo->storeAs('hc_pacientes', $nombreArchivo.'.pdf', 'public');
        $historiaClinica = new HistoriaClinica;
        $historiaClinica->paciente_id = $request->paciente_id;
        $historiaClinica->medico_id = $medico->id;
        $historiaClinica->cita_id = $request->cita_id;
        $historiaClinica->titulo = $request->titulo;
        $historiaClinica->diagnostico = $request->diagnostico;
        $historiaClinica->archivo_adjunto_path = basename($rutaArchivo);
        $historiaClinica->tipo = $request->tipo;
        $historiaClinica->save();
        Cita::where('id', $request->cita_id)->update(['estado' => 'Atendida']);

        return redirect()->route('historialClinico');
    }
    public function editarHC(Request $request,$idhc){
        $historiasClinicas = HistoriaClinica::where('id', $idhc)
            ->orderBy('created_at', 'desc')
            ->get();
        $hc = HistoriaClinica::find($idhc);
        $paciente=Paciente::buscarPacientePorDni($hc->paciente_id);
        $cita = Cita::obtenerCitasPorId($hc->cita_id);
        return view("historialClinico.editarHistoriaClinica", ['paciente' => $paciente,'cita' => $cita,'hc' => $hc,'historiasClinicas'=>$historiasClinicas]);
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        $id = $user->id;
        $idhc =$request->idhc;
        $medico = Medico::where('user_id', $id)->first();

        $validator = Validator::make($request->all(), [
            'archivo_respaldo' => 'nullable|file|mimes:pdf|max:2048',
            'paciente_id' => 'required|exists:pacientes,id',
            'cita_id' => 'required|exists:citas,id',
            'titulo' => 'required|string|max:255',
            'diagnostico' => 'required|string',
            'tipo' => ['required', Rule::in(['Inicial', 'Control'])],
        ]);

        $validator->stopOnFirstFailure();

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('message', 'Error al actualizar historia clínica. Verifica los campos e inténtalo de nuevo.')
                ->with('type', 'error');
        }

        $historiaClinica = HistoriaClinica::findOrFail($idhc);

        // Procesa la actualización del archivo adjunto solo si se proporciona uno nuevo
        if ($request->hasFile('archivo_respaldo')) {
            $archivoRespaldo = $request->file('archivo_respaldo');
            $uuid = Str::uuid();
            $nombreArchivo = "{$uuid}_";
            $rutaArchivo = $archivoRespaldo->storeAs('hc_pacientes', $nombreArchivo . '.pdf', 'public');

            // Elimina el archivo antiguo antes de guardar el nuevo
            Storage::disk('public')->delete('hc_pacientes/' . $historiaClinica->archivo_adjunto_path);

            $historiaClinica->archivo_adjunto_path = basename($rutaArchivo);
        }

        $historiaClinica->paciente_id = $request->paciente_id;
        $historiaClinica->medico_id = $medico->id;
        $historiaClinica->cita_id = $request->cita_id;
        $historiaClinica->titulo = $request->titulo;
        $historiaClinica->diagnostico = $request->diagnostico;
        $historiaClinica->tipo = $request->tipo;
        $historiaClinica->save();


        return redirect()->route('historialClinico')->with('success', 'Historia Clínica actualizada exitosamente');
    }
    public function delete(Request $request){
        return view("historialClinico.gestionHistoriaclinica");
    }
}
