<?php

namespace App\Mappers;

use App\Models\Horario;

class HorarioMapper
{
    public static function toHorario($horarioData)
    {
        return new Horario([
            'id' => $horarioData['id'],
            'dia' => $horarioData['dia'],
            'hora_inicio' => $horarioData['hora_inicio'],
            'hora_fin' => $horarioData['hora_fin'],
            'id_aula' => $horarioData['id_aula'],
            'id_materia' => $horarioData['id_materia'],
            'id_docente' => $horarioData['id_docente']
        ]);
    }

    public static function toHorarioData($horario)
    {
        return [
            'id' => $horario->id,
            'dia' => $horario->dia,
            'hora_inicio' => $horario->hora_inicio,
            'hora_fin' => $horario->hora_fin,
            'id_aula' => $horario->id_aula,
            'id_materia' => $horario->id_materia,
            'id_docente' => $horario->id_docente
        ];
    }
}
