<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HistoriasClinicasController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RespaldoMedicoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;



//<----pagina inicial---->
Route::get('', function () {
    return view('user.login');
});

//<----auth---->
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'loginStore'])->name('login');
Route::get('/cerrar-sesion',[AuthController::class,'logoutStore'])->name('cerrarSesion');

//<----inicio---->
Route::get('/inicio',[DashboardController::class,'index'])->name('inicio');

//<----Usuarios---->
Route::get('/usuario',[UsuarioController::class,'index'])->name('gestionUsuarios');
Route::post('/usuario',[UsuarioController::class,'store'])->name('registrarUsuario');
Route::put('/usuario',[UsuarioController::class,'update'])->name('editarUsuario');
Route::delete('/usuario',[UsuarioController::class,'destroy'])->name('eliminarUsuario');

// <----Paciente---->
Route::get('/paciente',[PacienteController::class,'index'])->name('gestionPacientes');
Route::post('/paciente',[PacienteController::class,'store'])->name('registrarPaciente');
Route::put('/paciente',[PacienteController::class,'update'])->name('editarPaciente');
Route::delete('/paciente',[PacienteController::class,'destroy'])->name('eliminarPaciente');
Route::get('/paciente/buscar/{dni}',[PacienteController::class,'search'])->name('buscarPaciente');

// <----Citas---->
Route::get('/cita',[CitaController::class,'index'])->name('gestionCitas');
Route::get('/cita/crear',[CitaController::class,'indexRegistrar'])->name('nuevaCita');
Route::post('/cita',[CitaController::class,'store'])->name('registrarCita');
Route::get('/cita/editar/{id}',[CitaController::class,'editarCita'])->name('editarCita');
Route::put('/cita/editar', [CitaController::class, 'update'])->name('editarCita');



// <----CalendarioCitas---->
Route::get('/calendario',[CalendarioController::class,'index'])->name('calendarioCitas');
Route::get('/calendario-medico',[CalendarioController::class,'indexmedico'])->name('medicoCalendario');


Route::get('/calendario/mostrar',[CalendarioController::class,'show'])->name('obetnerEventos');
Route::post('/calendario',[CalendarioController::class,'store'])->name('guardarEvento');


Route::get('/cita/cita-calendario/{estado}/{idMedico}/', [CitaController::class, 'citasCalendario'])->name('calendarioCita');
Route::get('/cita/medico-calendario/{id}/', [CitaController::class, 'medicoCalendario'])->name('calendariomedico');



// <----Historias Clinicas---->
Route::get('/sala-espera',[HistoriasClinicasController::class,'salaDeEspera'])->name('salaDeEspera');
Route::get('/historias-clinicas',[HistoriasClinicasController::class,'index'])->name('historialClinico');
Route::get('/historias-clinicas/crear/{idPaciente}/{idCita}',[HistoriasClinicasController::class,'indexRegistrar'])->name('registrarHistoriaClinica');
Route::post('/historias-clinicas/crear',[HistoriasClinicasController::class,'store'])->name('registrarHistoriaClinica');
Route::put('/historias-clinicas/editar',[HistoriasClinicasController::class,'update'])->name('editarHistoriaClinica');
Route::delete('/historias-clinicas/eliminar',[HistoriasClinicasController::class,'delete'])->name('deleteHistoriaClinica');


// <----Documentos---->
Route::get('/descargar-documento-inicial/{dni}',[DocumentController::class,'descargarDocumentoMedicoInicial'])->name('descargarDocumentoInicial');
Route::get('/descargar-documento-control/{dni}',[DocumentController::class,'descargarDocumentoMedicoControl'])->name('descargarDocumentoControl');

