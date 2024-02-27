<?php

use App\Http\Controllers\DisponibilidadController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\DocenteMateriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\HorarioPrevioDocenteController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;




// web

Route::get('/',[LoginController::class,'login'])->name('login');



Route::match('post', '/home', [HomeController::class, 'postLogin'])->name('postLogin');
Route::match('get', '/home', [HomeController::class, 'index'])->name('home');


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



//------------------------------------------------------------------------------------------------------------------------------------------------
// Swagger

// Aulas
Route::get('/api/aulas', 'App\Http\Controllers\AulaController@inicio');
Route::get('/api/aulas/{id}', 'App\Http\Controllers\AulaController@show');
Route::post('/api/aulas', 'App\Http\Controllers\AulaController@store');
Route::put('/api/aulas/actualizar/{id}', 'App\Http\Controllers\AulaController@update');
Route::delete('/api/aulas/eliminar/{id}', 'App\Http\Controllers\AulaController@destroy');

// Docentes
Route::get('/api/docentes', 'App\Http\Controllers\DocenteController@inicio');
Route::get('/api/docentes/{id}', 'App\Http\Controllers\DocenteController@obtenerDocentePorId');
Route::post('/api/docentes/guardar', 'App\Http\Controllers\DocenteController@guardarDocentes');
Route::put('/api/docentes/actualizar/{id}', 'App\Http\Controllers\DocenteController@actualizarDocentes');
Route::delete('/api/docentes/eliminar/{id}', 'App\Http\Controllers\DocenteController@eliminarDocentes');

// CambioDocente
Route::get('/api/cambioDocente', 'App\Http\Controllers\CambioDocenteController@obtenerTodosCambiosDocenteSwagger');
Route::get('/api/cambioDocente/{id}', 'App\Http\Controllers\CambioDocenteController@obtenerCambioDocentePorIdSwagger');
Route::post('/api/cambioDocente/guardar', 'App\Http\Controllers\CambioDocenteController@guardarCambioDocenteSwagger');
Route::put('/api/cambioDocente/actualizar/{id}', 'App\Http\Controllers\CambioDocenteController@actualizarCambioDocenteSwagger');
Route::delete('/api/cambioDocente/eliminar/{id}', 'App\Http\Controllers\CambioDocenteController@eliminarCambioDocentePorIdSwagger');

// Carreras
Route::get('/api/carreras', 'App\Http\Controllers\CarreraController@obtenerTodasCarrerasSwagger');
Route::get('/api/carreras/{id}', 'App\Http\Controllers\CarreraController@obtenerCarreraPorIdSwagger');
Route::post('/api/carreras/guardar', 'App\Http\Controllers\CarreraController@guardarCarreraSwagger');
Route::put('/api/carreras/actualizar/{id}', 'App\Http\Controllers\CarreraController@actualizarCarreraSwagger');
Route::delete('/api/carreras/eliminar/{id}', 'App\Http\Controllers\CarreraController@eliminarCarreraPorIdSwagger');

// Comisiones
Route::get('/api/comisiones', 'App\Http\Controllers\ComisionController@obtenerTodasComisionesSwagger');
Route::get('/api/comisiones/{id}', 'App\Http\Controllers\ComisionController@obtenerComisionPorIdSwagger');
Route::post('/api/comisiones/guardar', 'App\Http\Controllers\ComisionController@guardarComisionSwagger');
Route::put('/api/comisiones/actualizar/{id}', 'App\Http\Controllers\ComisionController@actualizarComisionSwagger');
Route::delete('/api/comisiones/eliminar/{id}', 'App\Http\Controllers\ComisionController@eliminarComisionPorIdSwagger');

// Disponibilidades
Route::get('/api/disponibilidad', 'App\Http\Controllers\DisponibilidadController@obtenerTodasDisponibilidadesswagger');
Route::get('/api/disponibilidad/{id}', 'App\Http\Controllers\DisponibilidadController@obtenerDisponibilidadPorIdswagger');
Route::post('/api/disponibilidad/guardar', 'App\Http\Controllers\DisponibilidadController@guardarDisponibilidadswagger');
Route::put('/api/disponibilidad/actualizar/{id}', 'App\Http\Controllers\DisponibilidadController@actualizarDisponibilidadswagger');
Route::delete('/api/disponibilidad/eliminar/{id}', 'App\Http\Controllers\DisponibilidadController@eliminarDisponibilidadPorIdswagger');

// Horarios
Route::get('/api/horarios', 'App\Http\Controllers\HorarioController@obtenerTodosHorariosSwagger');
Route::get('/api/horarios/{id}', 'App\Http\Controllers\HorarioController@obtenerHorarioPorIdSwagger');
Route::post('/api/horarios/guardar', 'App\Http\Controllers\HorarioController@guardarHorariosSwagger');
Route::put('/api/horarios/actualizar/{id}', 'App\Http\Controllers\HorarioController@actualizarHorariosSwagger');
Route::delete('/api/horarios/eliminar/{id}', 'App\Http\Controllers\HorarioController@eliminarHorariosSwagger');

// Materias
Route::get('/api/materias', 'App\Http\Controllers\MateriaController@obtenerTodasMateriasSwagger');
Route::get('/api/materias/{id}', 'App\Http\Controllers\MateriaController@obtenerMateriaPorIdSwagger');
Route::post('/api/materias/guardar', 'App\Http\Controllers\MateriaController@guardarMateriaSwagger');
Route::put('/api/materias/actualizar/{id}', 'App\Http\Controllers\MateriaController@actualizarMateriaSwagger');
Route::delete('/api/materias/eliminar/{id}', 'App\Http\Controllers\MateriaController@eliminarMateriaPorIdSwagger');
