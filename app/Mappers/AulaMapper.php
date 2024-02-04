<?php

namespace App\Mappers;

use App\Models\Aula;

class AulaMapper
{
    // se usa para crear el modelo
    public static function toAula($aulaData)
    {
        return new Aula([
            'nombre' => $aulaData->nombre,
            'capacidad' => $aulaData->capacidad,
            'tipo_aula' => $aulaData->tipo_aula,
        ]);
    }
    // se usa para mostrar en una vista
    public static function toAulaData($aula)
    {
        return [
            'nombre' => $aula->nombre,
            'capacidad' => $aula->capacidad,
            'tipo_aula' => $aula->tipo_aula,
        ];
    }

}
