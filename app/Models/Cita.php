<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cita extends Model
{
    use HasFactory;
    
    protected $table = 'citas';
    protected $fillable = ['id','paciente_id', 'fecha', 'motivo', 'resultados_medicos', 'medico_id', 'hora_id', 'estado'];

    public static function obtenerDatosCita() {
        return Cita::select('citas.*', 'pacientes.nombres', 'pacientes.apellidos', 'pacientes.dni')
        ->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
        ->get();
    }

    public static function crearCita($motivo, $paciente_id, $medico_id, $hora_id, $fecha)
    {
        DB::statement("INSERT INTO citas (motivo, paciente_id, medico_id, hora_id, fecha, estado)
            VALUES (?, ?, ?, ?, ?, ?)", [
            $motivo, $paciente_id, $medico_id, $hora_id, $fecha, 'pendiente'
        ]);
    }
}
