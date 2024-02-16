<?php

namespace App\Repositories;

interface DocenteMateriaRepository
{
    public function obtenerTodasDocentesMaterias();
    public function obtenerDocenteMateriaPorId($id);
    public function guardarDocenteMateria($docenteMateriaData);
    public function actualizarDocenteMateria($id, $dni_docente,$id_materia,$modulos_semanales);
    public function eliminarDocenteMateria($id);
}