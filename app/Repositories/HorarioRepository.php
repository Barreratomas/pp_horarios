<?php

namespace App\Repositories;

interface HorarioRepository
{
   
    public function guardarHorario($horarioData);
    public function actualizarHorario($id,$params);
    public function eliminarHorarioPorId($id);

}
