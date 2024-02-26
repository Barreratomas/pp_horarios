<?php

namespace App\Repositories;

interface HorarioRepository
{
   
    public function guardarHorario($params);
    public function actualizarHorario($id,$params);
    public function eliminarHorarioPorId($id);

     //------------------------------------------------------------------------------------------------------------------
     public function obtenerTodosHorariosSwagger();
     public function obtenerHorarioPorIdSwagger($id);
     public function guardarHorariosSwagger($horario);
     public function actualizarHorariosSwagger($horario, $id);
     public function eliminarHorariosSwagger($id);

}
