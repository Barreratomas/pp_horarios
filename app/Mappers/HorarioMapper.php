<?php
namespace App\Mappers;

use App\Models\Horario;

class HorarioMapper
{
    public static function toHorario($horarioData)
    {
        return new Horario([
            'dia' => $horarioData->dia,
            'modulo_inicio' => $horarioData->modulo_inicio,
            'modulo_fin' => $horarioData->modulo_fin,
            'v_p' => $horarioData->v_p,
            'id_disponibilidad' => $horarioData->id_disponibilidad,
            'materia' => $horarioData->materia,
            'aula' => $horarioData->aula,
            'comision' => $horarioData->comision,
        ]);
    }

    public static function toHorarioData($horario)
    {
        return [
            'dia' => $horario->dia,
            'modulo_inicio' => $horario->modulo_inicio,
            'modulo_fin' => $horario->modulo_fin,
            'v_p' => $horario->v_p,
            'id_disponibilidad' => $horario->id_disponibilidad,
            'materia' => $horario->materia,
            'aula' => $horario->aula,
            'comision' => $horario->comision,
        ];
    }
}