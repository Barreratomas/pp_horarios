<?php

namespace App\Repositories;


interface ComisionRepository
{
    public function obtenerTodasComisiones();
    public function obtenerComisionPorId($id);
    public function guardarComision( $anio,$division,$id_carrera,$capacidad);
    public function actualizarComision( $anio,$division,$id_carrera,$capacidad,$comision);
    public function eliminarComisionPorId($comision);


       //---------------------------------------------------------------------------------------------------------
    // Swagger

    public function obtenerTodasComisionSwagger();
    public function obtenerComisionPorIdSwagger($id);
    public function guardarComisionSwagger($Request);
    public function actualizarComisionSwagger($Request, $id);
    public function eliminarComisionPorIdSwagger($id);
}
