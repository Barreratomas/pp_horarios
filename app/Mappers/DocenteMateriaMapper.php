<?php
namespace App\Mappers;

use App\Models\DocenteMateria;

class DocenteMateriaMapper
{
    public static function toDocenteMateria($docenteMateriaData)
    {
        return new DocenteMateria([
            'dni_docente' => $docenteMateriaData->dni_docente,
            'id_materia' => $docenteMateriaData->id_materia,
            'id_aula' => $docenteMateriaData->id_aula,

        ]);
    }

    public static function toDocenteMateriaData($docenteMateria)
    {
        return [
            'dni_docente' => $docenteMateria->dni_docente,
            'id_materia' => $docenteMateria->id_materia,
            'id_aula' => $docenteMateria->id_aula,

        ];
    }
}