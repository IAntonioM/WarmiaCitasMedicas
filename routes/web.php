<?php

use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CerrarSesionController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\CrearUsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegistrarCitaController;
use App\Http\Controllers\RegistrarPacienteController;
use App\Http\Controllers\RespaldoMedicoController;
use Illuminate\Support\Facades\Route;



//<----pagina inicial---->
Route::get('/', function () {
    return view('index');
});

//<----auth---->
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store'])->name('login');
Route::get('/crear-usuario',[CrearUsuarioController::class,'index'])->name('crearUsuario');
Route::post('/crear-usuario',[CrearUsuarioController::class,'store'])->name('crearUsuario');
Route::get('/cerrar-sesion',[CerrarSesionController::class,'store'])->name('cerrarSesion');

//<----inicio---->
Route::get('/inicio',[DashboardController::class,'index'])->name('inicio');

// <----Paciente---->
Route::get('/paciente',[PacienteController::class,'index'])->name('gestionPacientes');
Route::post('/paciente',[PacienteController::class,'store'])->name('registrarPaciente');

// <----Citas---->
Route::get('/cita',[CitaController::class,'index'])->name('gestionCitas');
Route::get('/cita/crear',[CitaController::class,'registrarCita'])->name('registrarCita');
Route::post('/cita/crear',[CitaController::class,'store'])->name('registrarCita');
Route::post('/cita/buscar-paciente',[CitaController::class,'buscarPaciente'])->name('buscarPacienteEnCita');
Route::get('/cita/consultar-horario',[CitaController::class,'consultarHorarios'])->name('consultarHorarios');
Route::get('/cita/editar/{id}', [CitaController::class, 'editarCita'])->name('editarCita');



// <----CalendarioCitas---->
Route::get('/calendario',[CalendarioController::class,'index'])->name('calendarioCitas');

// <----RespaldoMedico---->
Route::get('/respaldo-medico',[RespaldoMedicoController::class,'index'])->name('respaldoMedico');
Route::get('/respaldo-medico/crear',[RespaldoMedicoController::class,'registrarRespaldoMedico'])->name('registrarRespaldoMedico');


