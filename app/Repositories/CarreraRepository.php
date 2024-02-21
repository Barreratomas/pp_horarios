<?php

namespace App\Repositories;

interface CarreraRepository
{
    public function obtenerTodasCarreras();
    public function obtenerCarreraPorId($id);
    public function guardarCarrera($nombre);
    public function actualizarCarrera($id,$nombre);
    public function eliminarCarreraPorId($id);
}