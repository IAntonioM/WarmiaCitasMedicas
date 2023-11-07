<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Paciente extends Model
{
    use HasFactory;
    protected $table = 'pacientes'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'dni',
        'fechaNacimiento',
        'direccion',
        'telefono',
    ];

    public static function crearPaciente($nombres, $apellidos, $dni, $fechaNacimiento, $direccion, $telefono)
    {
        DB::insert('INSERT INTO pacientes (nombres, apellidos, dni, fechaNacimiento, direccion, telefono) VALUES (?, ?, ?, ?, ?, ?)', [$nombres, $apellidos, $dni, $fechaNacimiento, $direccion, $telefono]);
    }

    public static function listarPacientes()
    {
        return DB::select('SELECT * FROM pacientes');
    }
    public static function buscarPacientePorDni($dni)
    {
        $result = DB::selectOne('SELECT * FROM pacientes WHERE dni = ? LIMIT 1', [$dni]);
        return $result ? new Paciente((array) $result) : null;
    }

}
