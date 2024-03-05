<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @OA\Schema(
 *     schema="Materia",
 *     title="Materia",
 *     description="Esquema del objeto Materia",
 *     @OA\Property(
 *          property="id_materia",
 *          type="integer",
 *          description="ID de la materia"
 *     ),
 *     @OA\Property(
 *          property="nombre",
 *          type="string",
 *          description="Nombre de la materia"
 *     )
 * )
 */
class Materia extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];
    protected $table = 'materias';
    protected $primaryKey = 'id_materia';


    //  Una materia puede ser enseñada por muchos docentes
    public function docenteMateria():HasMany{
        return $this->hasMany(DocenteMateria::class,'id_materia','id_materia');

    }

}
