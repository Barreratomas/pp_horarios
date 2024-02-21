<?php

namespace App\Repositories;

interface HorarioRepository
{
   
    public function guardarHorario($params);
    public function actualizarHorario($id,$params);
    public function eliminarHorarioPorId($id);

}
