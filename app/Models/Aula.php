<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
/**
 * @OA\Schema(
 *     schema="Aula",
 *     title="Aula",
 *     description="Esquema del objeto Aula",
 *     @OA\Property(
 *          property="id_aula",
 *          type="integer",
 *          description="Id del aula"
 *     ),
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
class Aula extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'tipo_aula'];
    protected $table = 'aulas';
    protected $primaryKey = 'id_aula';



    public function docenteMateria():HasMany{
        return $this->hasMany(docenteMateria::class,'id_aula','id_aula');

    }
}
