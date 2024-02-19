<?php

namespace App\Mappers;

use App\Models\Disponibilidad;

class DisponibilidadMapper
{
    public static function toDisponibilidad($disponibilidadData)
    {
        return new Disponibilidad([
            'id_dm' => $disponibilidadData->id_dm,
            'id_h_p_d' => $disponibilidadData->id_h_p_d,
            'id_aula' => $disponibilidadData->id_aula,
            'id_comision' => $disponibilidadData->id_comision,
            'dia' => $disponibilidadData->dia,
            'modulo_inicio' => $disponibilidadData->modulo_inicio,
            'modulo_fin' => $disponibilidadData->modulo_fin,
        ]);
    }

    public static function toDisponibilidadData($disponibilidad)
    {
        return [
            'id_dm' => $disponibilidad->id_dm,
            'id_h_p_d' => $disponibilidad->id_h_p_d,
            'id_aula' => $disponibilidad->id_aula,
            'id_comision' => $disponibilidad->id_comision,
            'dia' => $disponibilidad->dia,
            'modulo_inicio' => $disponibilidad->modulo_inicio,
            'modulo_fin' => $disponibilidad->modulo_fin,
        ];
    }
}
