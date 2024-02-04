<?php
namespace App\Mappers;

use App\Models\Horario;

class HorarioMapper
{
    public static function toHorario($horarioData)
    {
        return new Horario([
            'dia' => $horarioData->dia,
            'hora_inicio' => $horarioData->hora_inicio,
            'hora_fin' => $horarioData->hora_fin,
            'v_p' => $horarioData->v_p,
            'id_dm' => $horarioData->id_dm,
            'id_aula' => $horarioData->id_aula,
            'id_comision' => $horarioData->id_comision,
        ]);
    }

    public static function toHorarioData($horario)
    {
        return [
            'dia' => $horario->dia,
            'hora_inicio' => $horario->hora_inicio,
            'hora_fin' => $horario->hora_fin,
            'v_p' => $horario->v_p,
            'id_dm' => $horario->id_dm,
            'id_aula' => $horario->id_aula,
            'id_comision' => $horario->id_comision,
        ];
    }
}