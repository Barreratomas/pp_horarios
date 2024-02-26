<?php

namespace App\Data;

use Dflydev\DotAccessData\Data;

/**
 * @OA\Schema(
 *     schema="MateriaData",
 *     title="MateriaData",
 *     description="Esquema del objeto MateriaData",
 *     @OA\Property(
 *          property="nombre",
 *          type="string",
 *          description="Nombre del Materia"
 *     )
 * )
 */
class MateriaData extends Data
{
    public function __construct(
        public $nombre
    ){
    }
}
