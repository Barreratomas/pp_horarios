<?php
namespace App\Mappers;

use App\Models\Carrera;

class CarreraMapper
{
    public static function toCarrera($carreraData)
    {
        return new Carrera([
            'nombre' => $carreraData->nombre,
        ]);
    }

    public static function toCarreraData($carrera)
    {
        return [
            'nombre' => $carrera->nombre,
        ];
    }
}