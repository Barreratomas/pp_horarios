<?php

namespace App\Repositories;

interface MateriaRepository
{
    public function obtenerTodasMaterias();
    public function obtenerMateriaPorId($id);
    public function guardarMateria($nombre,$modulos_semanales);
    public function actualizarMateria($id,$nombre,$modulos_semanales);
    public function eliminarMateriaPorId($id);
}
