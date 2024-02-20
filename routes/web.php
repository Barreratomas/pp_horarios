<?php

use App\Http\Controllers\DisponibilidadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorarioController;
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


// web
Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/horarios',[HorarioController::class,'mostrarFormularioPartial'])->name('mostrarFormulario');

Route::post('/horarios', [HorarioController::class,'mostrarHorario'])->name('mostrarHorario');




Route::get('/disponibilidad',[DisponibilidadController::class,'index'])->name('indexDisponibilidad');