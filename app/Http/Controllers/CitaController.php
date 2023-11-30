<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\HoraAtencion;
use App\Models\Horario;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class CitaController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function index(Request $request){
        $busqueda=$request->busqueda;  
        $medicos = Medico::obtenerMedicos();
        $citas = Cita::obtenerCitas($busqueda);
        return view("cita.gestionCitas", ['citas' => $citas,'medicos' => $medicos,'busqueda'=>$busqueda]);
    }
    public function indexRegistrar()
    {
        $medicos = Medico::obtenerMedicos();
        return view("cita.registrarCita", ['medicos' => $medicos]);
    }
    public function store(Request $request){
        $medico_id = $request->input('medico');
        $paciente_id = $request->input('idPaciente');
        $hora = $request->input('hora');
        $fecha_hora = $request->input('fecha'). " " . $hora;
        $motivo_consulta = $request->input('motivo_consulta');
        $estado = "Pendiente";
        Cita::crearCita($medico_id, $paciente_id, $fecha_hora, $motivo_consulta, $estado);
        }
        public function citasCalendario($estado, $idMedico){
            $events = array();
    
            $citasQuery = Cita::query();
        
            // Verificar si se proporciona un estado específico
            if ($estado !== 'Todos') {
                $citasQuery->where('estado', $estado);
            }
        
            // Verificar si se proporciona un idMedico específico
            if ($idMedico > 0) {
                // Si es mayor que 0, aplicar el filtro por medico_id
                $citasQuery->where('medico_id', $idMedico);
            }
        
            // Obtener todas las citas según los filtros aplicados
            $citas = $citasQuery->get();
            foreach($citas as $cita){
                switch($cita->estado){
                    case 'Pendiente':
                        $color = '#FFFF00';// Akarillo
                        $textColor= "#000";
                        break;
                    case 'Cancelada':
                        $color = '#FF0000'; // Rojo
                        $textColor= "#fff";
                        break;
                    case 'Confirmada':
                        $color = '#008000'; // Verde
                        $textColor= "#fff";
                        break;
                    case 'Atendido':
                        $color = '#0000FF'; // Azul
                        $textColor= "#fff";
                        break;
                    default:
                        $color = '#000000'; // Por defecto, puede cambiar según tus necesidades
                }
                $events[] = [
                    'title' => $cita->estado,
                    'start' => $cita->fecha_hora,
                    'idCita' => $cita->id,
                    'end' => $cita->fecha_hora,
                    'color' => $color,
                    'textColor' => $textColor,
                ];
            }
        
            return response()->json($events);
        }
        public function medicoCalendario($id){
            $events = array();
            $medico = Medico::where('user_id', $id)->first();
        
            if ($medico) {
                $citas = Cita::where('medico_id', $medico->id)->get();
        
                foreach($citas as $cita){
                    switch($cita->estado){
                        case 'Pendiente':
                            $color = '#FFFF00';// Amarillo
                            $textColor = "#000";
                            break;
                        case 'Cancelada':
                            $color = '#FF0000'; // Rojo
                            $textColor = "#fff";
                            break;
                        case 'Confirmada':
                            $color = '#008000'; // Verde
                            $textColor = "#fff";
                            break;
                        case 'Atendido':
                            $color = '#0000FF'; // Azul
                            $textColor = "#fff";
                            break;
                        default:
                            $color = '#000000'; // Por defecto, puede cambiar según tus necesidades
                            $textColor = "#fff";
                    }
        
                    $events[] = [
                        'title' => $cita->estado,
                        'start' => $cita->fecha_hora,
                        'idCita' => $cita->id,
                        'end' => $cita->fecha_hora,
                        'color' => $color,
                        'textColor' => $textColor,
                    ];
                }
            }
        
            return response()->json($events);
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
        $medicos = Medico::obtenerMedicos();
        $cita=Cita::obtenerCitasPorId($id);
        $cita[0]->fecha = Carbon::parse($cita[0]->fecha_hora)->format('Y-m-d');
        $cita[0]->hora = Carbon::parse($cita[0]->fecha_hora)->format('H:i');
        return view('cita.editarCita')->with(['medicos'=> $medicos,'Cita' => $cita]);

    }public function update(Request $request){
        $id = $request->input('idCita');
        $fecha = $request->input('fecha');
        $hora = $request->input('hora');
        $medico_id = $request->input('medico');
        $estado = $request->input('estado');
        $motivo_consulta = $request->input('motivo_consulta');
        Cita::actualizarCita($id, $fecha, $hora, $medico_id, $estado, $motivo_consulta);
        return redirect()->route('gestionCitas')->with('success', 'Cita actualizada exitosamente');
   
    }
   
}
