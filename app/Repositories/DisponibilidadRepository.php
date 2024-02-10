<?php

namespace App\Repositories;


interface DisponibilidadRepository
{
    public function obtenerTodasDisponibilidades();
    public function obtenerDisponibilidadPorId($id);
    public function guardarDisponibilidad($disponibilidadData);
    public function actualizarDisponibilidad($id,$params);
    public function  eliminarDisponibilidadPorId($id);
}
