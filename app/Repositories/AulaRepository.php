<?php

namespace App\Repositories;

interface AulaRepository
{
    public function obtenerTodasAulas();
    public function obtenerAulasPorTipo($tipo);
    public function obtenerAula($id);
    public function guardarAula($aulaData);
    public function actualizarAula($id,$nombre,$tipo_aula,$capacidad);
    public function eliminarAula($id);
}
