<?php
namespace App\Mappers;

use App\Models\CambioDocente;

class CambioDocenteMapper
{
    public static function toCambioDocente($cambioDocenteData)
    {
        return new CambioDocente([
            'docente_anterior' => $cambioDocenteData->docente_anterior,
            'docente_nuevo' => $cambioDocenteData->docente_nuevo,
        ]);
    }

    public static function toCambioDocenteData($cambioDocente)
    {
        return [
            'docente_anterior' => $cambioDocente->docente_anterior,
            'docente_nuevo' => $cambioDocente->docente_nuevo,
        ];
    }
}
