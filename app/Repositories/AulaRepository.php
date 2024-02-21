<?php

namespace App\Repositories;

interface AulaRepository
{
    public function obtenerTodasAulas();
    public function obtenerAula($id);
    public function guardarAula($nombre,$tipo_aula,$capacidad);
    public function actualizarAula($id,$nombre,$tipo_aula,$capacidad);
    public function eliminarAula($id);
}
