<?php


namespace App\Data;

use Dflydev\DotAccessData\Data;

/**
 * @OA\Schema(
 *     schema="DisponibilidadData",
 *     title="DisponibilidadData",
 *     description="Esquema del objeto DisponibilidadData",
 *     @OA\Property(
 *          property="id_disponibilidad",
 *          type="integer",
 *          description="ID de la disponibilidad"
 *     ),
 *     @OA\Property(
 *          property="id_dm",
 *          type="integer",
 *          description="ID del docente materia"
 *     ),
 *     @OA\Property(
 *          property="id_h_p_d",
 *          type="integer",
 *          description="ID de la hora por dia"
 *     ),
 *     @OA\Property(
 *          property="id_aula",
 *          type="integer",
 *          description="ID del aula"
 *     ),
 *     @OA\Property(
 *          property="dia",
 *          type="string",
 *          description="Dia de la disponibilidad"
 *     ),
 *     @OA\Property(
 *          property="modulo_inicio",
 *          type="integer",
 *          description="Modulo de inicio de la disponibilidad"
 *     ),
 *     @OA\Property(
 *          property="modulo_fin",
 *          type="integer",
 *          description="Modulo de fin de la disponibilidad"
 *     )
 * )
 */
class DisponibilidadData extends Data
{
    public function __construct(
        public $id_disponibilidad,
        public $id_dm,
        public $id_h_p_d,
        public $id_aula,
        public $dia,
        public $modulo_inicio,
        public $modulo_fin
    ){

    }
}
