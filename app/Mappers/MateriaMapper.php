<?php

namespace App\Mappers;

use App\Models\Materia;

class MateriaMapper
{
    public static function toMateria($materiaData)
    {
        return new Materia([
            'nombre' => $materiaData->nombre,
            'modulos_semanales' => $materiaData->modulos_semanales,
        ]);
    }

    public static function toMateriaData($materia)
    {
        return [
            'nombre' => $materia->nombre,
            'modulos_semanales' => $materia->modulos_semanales,
        ];
    }
}
