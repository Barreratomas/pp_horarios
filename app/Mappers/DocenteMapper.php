<?php
// app/Mappers/DocenteMapper.php
namespace App\Mappers;

use App\Models\Docente;

class DocenteMapper
{
    public static function toDocente($docenteData)
    {
        return new Docente([
            'dni' => $docenteData->dni,
            'nombre' => $docenteData->nombre,
            'apellido' => $docenteData->apellido,
            'email' => $docenteData->email,
        ]);
    }

    public static function toDocenteData($docente)
    {
        return [
            'dni' => $docente->dni,
            'nombre' => $docente->nombre,
            'apellido' => $docente->apellido,
            'email' => $docente->email,
        ];
    }
}
