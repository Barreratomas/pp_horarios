<?php

namespace App\Repositories;


interface DisponibilidadRepository
{
    public function obtenerTodasDisponibilidades();
    public function obtenerDisponibilidadPorId($id);
    public function horaPrevia($id_h_p_d);
    public function modulosRepartidos($modulos_semanales,$moduloPrevio,$id_dm,$id_comision,$id_aula,$diaInstituto);
    public function guardarDisponibilidad($params);
    public function actualizarDisponibilidad($id,$params);
    public function  eliminarDisponibilidadPorId($id);


    //------------------------------------------------------------------------------------------------------------------
    // swagger
    public function obtenerTodasDisponibilidadesswagger();
    public function obtenerDisponibilidadPorIdswagger($id);
    public function guardarDisponibilidadswagger($params);
    public function actualizarDisponibilidadswagger($params, $id);
    public function  eliminarDisponibilidadPorIdswagger($id);
}
