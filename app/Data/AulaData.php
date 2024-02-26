<?php

namespace App\Data;

use Dflydev\DotAccessData\Data;

/**
 * @OA\Schema(
 *     schema="AulaData",
 *     title="AulaData",
 *     description="Esquema del objeto AulaData",
 *     @OA\Property(
 *          property="nombre",
 *          type="string",
 *          description="Nombre del aula"
 *     ),
 *     @OA\Property(
 *          property="capacidad",
 *          type="integer",
 *          description="Capacidad del aula"
 *     ),
 *     @OA\Property(
 *          property="tipo_aula",
 *          type="string",
 *          description="Tipo de aula"
 *     )
 * )
 */
class AulaData extends Data
{
    public function __construct(
        public $nombre,
        public $capacidad,
        public $tipo_aula
    ){

    }
}
