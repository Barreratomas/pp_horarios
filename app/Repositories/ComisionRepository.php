<?php

namespace App\Repositories;


interface ComisionRepository
{
    public function obtenerTodasComisiones();
    public function obtenerComisionPorId($id);
    public function guardarComision( $anio,$division,$capacidad);
    public function actualizarComision($id, $anio,$division,$capacidad);
    public function eliminarComisionPorId($id);
}
