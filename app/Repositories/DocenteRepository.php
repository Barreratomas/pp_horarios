<?php

namespace App\Repositories;


interface DocenteRepository
{
    public function obtenerTodosDocentes();
    public function obtenerDocentePorDni($dni);
    public function guardarDocente($dni,$nombre,$apellido,$email);
    public function actualizarDocente($dni,$nombre,$apellido,$email);
    public function eliminarDocentePorDni($dni);
}
