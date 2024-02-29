<?php

namespace App\Repositories;


interface DocenteRepository
{
    public function obtenerTodosDocentes();
    public function obtenerDocentePorDni($dni);
    public function guardarDocente($dni,$nombre,$apellido,$email);
    public function actualizarDocente($nombre,$apellido,$email,$docente);
    public function eliminarDocente($docente);

    // Swagger
    public function obtenerDocente();
    public function obtenerDocentePorId($id);
    public function guardarDocentes($docente);
    public function actualizarDocentes($docente, $id);
    public function eliminarDocentes($id);
}
