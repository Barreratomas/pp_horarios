<?php

namespace App\Data;

use Dflydev\DotAccessData\Data;

/**
 * @OA\Schema(
 *     schema="ComisionData",
 *     title="ComisionData",
 *     description="Esquema del objeto ComisionData",
 *     @OA\Property(
 *          property="anio",
 *     type="integer",
 *     description="Año de la comision"
 *    ),
 *     @OA\Property(
 *     property="division",
 *     type="string",
 *     description="Division de la comision"
 *   ),
 *     @OA\Property(
 *     property="id_carrera",
 *     type="integer",
 *     description="Id de la carrera"
 *  ),
 *     @OA\Property(
 *     property="capacidad",
 *     type="integer",
 *     description="Capacidad de la comision"
 *  )
 * )
 */
class ComisionData extends Data{
    public function __construct(
        public $anio,
        public $division,
        public $id_carrera,
        public $capacidad
    ){

    }
}
