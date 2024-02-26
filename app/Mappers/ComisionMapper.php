<?php

namespace App\Mappers;

use App\Models\Comision;

class ComisionMapper
{
    public static function toComision($comisionData)
    {
        return new Comision([
            'anio' => $comisionData['anio'],
            'cuatrimestre' => $comisionData['cuatrimestre'],
            'nombre' => $comisionData['nombre'],
            'docente_id' => $comisionData['docente_id'],
            'materia_id' => $comisionData['materia_id']
        ]);
    }

    public static function toComisionData($comision)
    {
        return [
            'anio' => $comision->anio,
            'cuatrimestre' => $comision->cuatrimestre,
            'nombre' => $comision->nombre,
            'docente_id' => $comision->docente_id,
            'materia_id' => $comision->materia_id
        ];
    }

}
