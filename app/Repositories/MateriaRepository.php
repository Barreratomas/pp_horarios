<?php

namespace App\Repositories;

interface MateriaRepository
{
    public function obtenerTodasMaterias();
    public function obtenerMateriaPorId($id);
    public function guardarMateria($nombre,$modulos_semanales);
    public function actualizarMateria($id,$nombre,$modulos_semanales);
    public function eliminarMateriaPorId($id);


     //-----------------------------------------------------------------------------
    // Swagger

    public function obtenerTodasMateriasSwagger();
    public function obtenerMateriaPorIdSwagger($id);
    public function guardarMateriaSwagger($nombre,$modulos_semanales);
    public function actualizarMateriaSwagger($id,$nombre,$modulos_semanales);
    public function eliminarMateriaPorIdSwagger($id);
}
