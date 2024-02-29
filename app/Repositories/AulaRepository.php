<?php

namespace App\Repositories;

interface AulaRepository
{
    public function obtenerTodasAulas();
    public function obtenerAula($id);
    public function guardarAula($nombre,$tipo_aula,$capacidad);
    public function actualizarAula($nombre,$tipo_aula,$capacidad,$aula);
    public function eliminarAula($aula);

        // Swagger
    public function obtenerAulas();
    public function obtenerAulaPorId($id);
    public function guardarAulas($aula);
    public function actualizarAulas($aula, $id);
    public function eliminarAulas($id);
}
