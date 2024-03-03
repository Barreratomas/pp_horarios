<?php

namespace App\Repositories;

interface DocenteMateriaRepository
{
    public function obtenerTodasDocentesMaterias();
    public function obtenerDocenteMateriaPorId($id);
    public function guardarDocenteMateria( $dni_docente,$id_materia,$id_aula,$id_comision);
    public function actualizarDocenteMateria($dm,$id_materia,$id_aula,$id_comision);
    public function eliminarDocenteMateria($id);
}