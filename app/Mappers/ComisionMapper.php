<?php

namespace App\Mappers;

use App\Models\Comision;

class ComisionMapper
{
public static function toComision($comisionData)
    {
        return new Comision([
            'anio' => $comisionData->anio,
            'division' => $comisionData->division,
            'id_carrera' => $comisionData->carrera,
            'capacidad' => $comisionData->capacidad,
        ]);
    }


public static function toComisionData($comision)
    {
        return [
            'anio' => $comision->anio,
            'division' => $comision->division,
            'id_carrera' => $comision->id_carrera,
            'capacidad' => $comision->capacidad,
        ];
    }
}
