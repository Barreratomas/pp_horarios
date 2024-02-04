<?php

namespace App\Mappers;

use App\Models\Disponibilidad;

class DisponibilidadMapper
{
    public static function toDisponibilidad($disponibilidadData)
    {
        return new Disponibilidad([
            'id_dm' => $disponibilidadData->id_dm,
            'dia' => $disponibilidadData->dia,
            'hora_inicio' => $disponibilidadData->hora_inicio,
            'hora_fin' => $disponibilidadData->hora_fin,
        ]);
    }

    public static function toDisponibilidadData($disponibilidad)
    {
        return [
            'id_dm' => $disponibilidad->id_dm,
            'dia' => $disponibilidad->dia,
            'hora_inicio' => $disponibilidad->hora_inicio,
            'hora_fin' => $disponibilidad->hora_fin,
        ];
    }
}
