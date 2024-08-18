<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Carrera",
 *     title="Carrera",
 *     description="Esquema del objeto Carrera",
 *     @OA\Property(
 *          property="id_carrera",
 *          type="integer",
 *          description="Id de la carrera"
 *     ),
 *     @OA\Property(
 *          property="nombre",
 *          type="string",
 *          description="Nombre de la carrera"
 *     )
 * )
 */
class Carrera extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];
    protected $table = 'carreras';
    protected $primaryKey = 'id_carrera';

// Una carrera puede tener muchas comisiones asociadas
    public function comision():HasMany{
        return $this->hasMany(Comision::class, 'id_carrera', 'id_carrera');
    }
    public function usuario():HasMany{
        return $this->hasMany(usuario::class, 'id_carrera', 'id_carrera');
    }
    public function horarios():HasMany{
        return $this->hasMany(Horario::class, 'id_carrera', 'id_carrera');
    }
}
