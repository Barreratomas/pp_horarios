<?php


namespace App\Data;

use Dflydev\DotAccessData\Data;

/**
 * @OA\Schema(
 *     schema="CambiosDocenteData",
 *     title="CambiosDocenteData",
 *     description="Esquema del objeto CambiosDocenteData",
 *     @OA\Property(
 *     property="docente_anterior",
 *     type="string",
 *     description="DNI del docente anterior"
 *    ),
 *     @OA\Property(
 *     property="docente_nuevo",
 *     type="string",
 *     description="DNI del docente nuevo"
 *   )
 * )
 */
class CambiosDocenteData extends Data{
    public function __construct(
        public $docente_anterior,
        public $docente_nuevo
    ){

    }
}
