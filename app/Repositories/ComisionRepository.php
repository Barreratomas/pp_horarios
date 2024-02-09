<?php

namespace App\Repositories;


interface ComisionRepository
{
    public function obtenerTodasComisiones();
    public function obtenerTodasComisionesPorCarrera($carrera);
    public function obtenerComisionPorId($id);
    public function guardarComision($comisionData);
    public function actualizarComision($id, $anio,$division,$capacidad);
    public function eliminarComisionPorId($id);
}
