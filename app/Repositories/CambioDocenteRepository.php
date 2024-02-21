<?php

namespace App\Repositories;

interface CambioDocenteRepository
{
    public function obtenerTodosCambiosDocente();
    public function obtenerCambioDocentePorId($id);
    public function guardarCambioDocente($docente_anterior,$docente_nuevo);
    public function actualizarCambioDocente($id,$docente_anterior,$docente_nuevo);
    public function eliminarCambioDocentePorId($id);
}