<?php

namespace App\Mappers;

use App\Models\Materia;

class MateriaMapper
{
    public static function toMateria($materiaData)
    {
        return new Materia([
            'nombre' => $materiaData->nombre,
        ]);
    }

    public static function toMateriaData($materia)
    {
        return [
            'nombre' => $materia->nombre,
        ];
    }
}
