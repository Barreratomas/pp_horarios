<?php

namespace App\Repositories;

interface CambioDocenteRepository
{
    public function obtenerTodosCambiosDocente();
    public function obtenerCambioDocentePorId($id);
    public function guardarCambioDocente($cambioDocenteData);
    public function actualizarCambioDocente($id,$docente_anterior,$docente_nuevo,$fecha_cambio);
    public function eliminarCambioDocentePorId($id);
}