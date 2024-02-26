<?php


namespace App\Mappers;

use App\Models\Materia;

class MateriaMapper
{
    public static function toMateria($materiaData)
    {
        return new Materia([
            'id_materia' => $materiaData->id_materia,
            'nombre' => $materiaData->nombre
        ]);
    }

    public static function toMateriaData($materia)
    {
        return [
            'nombre' => $materia->nombre
        ];
    }

}


