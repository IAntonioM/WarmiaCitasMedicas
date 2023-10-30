<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/register', [RegisterController::class,'index'])->name('register');

Route::get('/login',[LoginController::class,'index'])->name('login');

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::get('/dashboard/home',[DashboardController::class,'index'])->name('dashboard1');

Route::get('/dashboard/calendario-citas',[DashboardController::class,'index'])->name('dashboard2');

Route::get('/dashboard/gestion-citas',[DashboardController::class,'gestion'])->name('dashboard3');