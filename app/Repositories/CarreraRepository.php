<?php

namespace App\Repositories;

interface CarreraRepository
{
    public function obtenerTodasCarreras();
    public function obtenerCarreraPorId($id);
    public function guardarCarrera($nombre);
    public function actualizarCarrera($nombre,$carrera);
    public function eliminarCarreraPorId($carrera);

      //---------------------------------------------------------------------------------------------------------
    // Swagger

    public function obtenerTodosCarreraSwagger();
    public function obtenerCarreraPorIdSwagger($id);
    public function guardarCarreraSwagger($Request);
    public function actualizarCarreraSwagger($Request, $id);
    public function eliminarCarreraPorIdSwagger($id);
}