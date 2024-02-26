<?php

namespace App\Repositories;


interface ComisionRepository
{
    public function obtenerTodasComisiones();
    public function obtenerComisionPorId($id);
    public function guardarComision( $anio,$division,$capacidad);
    public function actualizarComision($id, $anio,$division,$capacidad);
    public function eliminarComisionPorId($id);


       //---------------------------------------------------------------------------------------------------------
    // Swagger

    public function obtenerTodasComisionSwagger();
    public function obtenerComisionPorIdSwagger($id);
    public function guardarComisionSwagger($Request);
    public function actualizarComisionSwagger($Request, $id);
    public function eliminarComisionPorIdSwagger($id);
}
