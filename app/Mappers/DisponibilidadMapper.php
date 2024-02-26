<?php


namespace App\Mappers;

use App\Models\Disponibilidad;

class DisponibilidadMapper
{
    public static function toDisponibilidad($disponibilidadData)
    {
        return new Disponibilidad([
            'id_disponibilidad' => $disponibilidadData['id_disponibilidad'],
            'id_dm' => $disponibilidadData['id_dm'],
            'id_h_p_d' => $disponibilidadData['id_h_p_d'],
            'id_aula' => $disponibilidadData['id_aula'],
            'dia' => $disponibilidadData['dia'],
            'modulo_inicio' => $disponibilidadData['modulo_inicio'],
            'modulo_fin' => $disponibilidadData['modulo_fin']
]);
    }

    public static function toDisponibilidadData($disponibilidad)
    {
        return [
            'id_disponibilidad' => $disponibilidad->id_disponibilidad,
            'id_dm' => $disponibilidad->id_dm,
            'id_h_p_d' => $disponibilidad->id_h_p_d,
            'id_aula' => $disponibilidad->id_aula,
            'dia' => $disponibilidad->dia,
            'modulo_inicio' => $disponibilidad->modulo_inicio,
            'modulo_fin' => $disponibilidad->modulo_fin
        ];
    }

}
