<?php

namespace App\Repositories;


interface HorarioPrevioDocenteRepository
{
    public function obtenerTodosHorariosPreviosDocentes();
    public function obtenerHorarioPrevioDocentePorId($id_h_p_d);
    public function guardarHorarioPrevioDocente($dni_docente,$dia,$hora);
    public function actualizarHorarioPrevioDocente($dia,$hora,$h_p_d);
    public function  eliminarHorarioPrevioDocentePorId($h_p_d);
}
