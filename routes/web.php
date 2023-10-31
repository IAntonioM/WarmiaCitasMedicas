<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\CrearUsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegistrarCitaController;
use App\Http\Controllers\RegistrarPacienteController;
use Illuminate\Support\Facades\Route;



//<----inicio---->
Route::get('/', function () {
    return view('index');
});

//<----auth---->
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::get('/crear-usuario',[CrearUsuarioController::class,'index'])->name('crearUsuario');
Route::post('/crear-usuario',[CrearUsuarioController::class,'store'])->name('crearUsuario');


//<----dashboard---->
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');


// <----Citas---->
Route::get('/dashboard/gestion-citas',[CitaController::class,'index'])->name('gestionCitas');
Route::get('/dashboard/registrar-cita',[RegistrarCitaController::class,'index'])->name('registrarCita');


// <----Paciente---->
Route::get('/dashboard/gestion-pacientes',[PacienteController::class,'index'])->name('gestionPacientes');
Route::get('/dashboard/registrar-paciente',[RegistrarPacienteController::class,'index'])->name('registrarPaciente');    