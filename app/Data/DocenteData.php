<?php

namespace App\Data;

use Dflydev\DotAccessData\Data;

/**
 * @OA\Schema(
 *     schema="DocenteData",
 *     title="DocenteData",
 *     description="Esquema del objeto DocenteData",
 *     @OA\Property(
 *          property="dni",
 *          type="string",
 *          description="DNI del docente"
 *     ),
 *     @OA\Property(
 *          property="nombre",
 *          type="string",
 *          description="Nombre del docente"
 *     ),
 *     @OA\Property(
 *          property="apellido",
 *          type="string",
 *          description="Apellido del docente"
 *     ),
 *     @OA\Property(
 *          property="email",
 *          type="string",
 *          description="Email del docente"
 *     )
 * )
 */
class DocenteData extends Data
{
    public function __construct(
        public $dni,
        public $nombre,
        public $apellido,
        public $email
    ){

    }
}
