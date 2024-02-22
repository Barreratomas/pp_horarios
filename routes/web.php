<?php

use App\Http\Controllers\DisponibilidadController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\DocenteMateriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\HorarioPrevioDocenteController;
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






Route::get('/docente',[DocenteController::class,'index'])->name('docentes.index');
Route::get('/docente/crear-docente',[DocenteController::class,'crear'])->name('mostrarFormularioDocente');
Route::post('/docente/crear-docente',[DocenteController::class,'store'])->name('storeDocente');


Route::get('/crear-h-p-v',[HorarioPrevioDocenteController::class,'crear'])->name('mostrarFormularioHPD');
Route::post('/crear-h-p-v',[HorarioPrevioDocenteController::class,'store'])->name('storeHPD');


Route::get('/docente-materia',[DocenteMateriaController::class,'index'])->name('docenteMateria.index');
Route::get('/docente-materia/crear-docente-materia',[DocenteMateriaController::class,'crear'])->name('mostrarFormularioDocenteMateria');
Route::post('/docente-materia/crear-docente-materia',[DocenteMateriaController::class,'store'])->name('storeDocenteMateria');


// Route::get('/disponibilidad',[DisponibilidadController::class,'crear'])->name('mostrarFormularioDisponibilidad');
Route::get('/disponibilidad',[DisponibilidadController::class,'store'])->name('storeDisponibilidad');
Route::get('/disponibilidad/disponibilidad-index',[DisponibilidadController::class,'redireccionar'])->name('redireccionarDisponibilidad');
Route::get('/disponibilidad/disponibilidad-index-index',[DisponibilidadController::class,'redireccionarError'])->name('redireccionarDisponibilidadError');


Route::get('/horario',[HorarioController::class,'mostrarFormularioPartial'])->name('mostrarFormularioHorario');
Route::post('/horario', [HorarioController::class,'mostrarHorario'])->name('mostrarHorario');
// Route::get('horario/crear-horario',[HorarioController::class,'crear'])->name('crearHorario');
Route::get('/horario/crear-horario',[HorarioController::class,'store'])->name('storeHorario');
