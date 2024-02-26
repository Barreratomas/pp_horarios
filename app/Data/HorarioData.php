<?php

namespace App\Data;

use Dflydev\DotAccessData\Data;

/**
 * @OA\Schema(
 *     schema="HorarioData",
 *     title="HorarioData",
 *     description="Esquema del objeto HorarioData",
 *     @OA\Property(
 *          property="id",
 *          type="integer",
 *          description="Id del horario"
 *     ),
 *     @OA\Property(
 *          property="hora_inicio",
 *          type="string",
 *          description="Hora de inicio del horario"
 *     ),
 *     @OA\Property(
 *          property="hora_fin",
 *          type="string",
 *          description="Hora de fin del horario"
 *     ),
 *     @OA\Property(
 *          property="dia",
 *          type="string",
 *          description="Dia del horario"
 *     )
 * )
 */
class HorarioData extends Data
{
    public function __construct(
        public $id,
        public $hora_inicio,
        public $hora_fin,
        public $dia
    ){

    }
}
