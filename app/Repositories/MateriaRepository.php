<?php

namespace App\Repositories;

interface MateriaRepository
{
    public function obtenerTodasMaterias();
    public function obtenerMateriaPorId($id);
    public function guardarMateria($materia);
    public function actualizarMateria($materia, $id);
    public function eliminarMateriaPorId($id);
}
