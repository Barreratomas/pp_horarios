<?php


namespace App\Data;

use Dflydev\DotAccessData\Data;

/**
 * @OA\Schema(
 *     schema="CarreraData",
 *     title="CarreraData",
 *     description="Esquema del objeto CarreraData",
 *     @OA\Property(
 *          property="nombre",
 *          type="string",
 *          description="Nombre de la carrera"
 *     )
 * )
 */
class CarreraData extends Data{
    public function __construct(
        public $nombre
    ){

    }
}
