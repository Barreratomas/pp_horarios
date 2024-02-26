<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @OA\Schema(
 *     schema="Comision",
 *     title="Comision",
 *     description="Esquema del objeto Comision",
 *     @OA\Property(
 *          property="id_comision",
 *          type="integer",
 *          description="Id de la comision"
 *     ),
 *     @OA\Property(
 *          property="anio",
 *          type="integer",
 *          description="Año de la comision"
 *     ),
 *     @OA\Property(
 *          property="division",
 *          type="string",
 *          description="Division de la comision"
 *     ),
 *     @OA\Property(
 *          property="id_carrera",
 *          type="integer",
 *          description="Id de la carrera"
 *     ),
 *     @OA\Property(
 *          property="capacidad",
 *          type="integer",
 *          description="Capacidad de la comision"
 *     )
 * )
 */
class Comision extends Model
{
    use HasFactory;

    protected $fillable = ['anio', 'division', 'id_carrera', 'capacidad'];
    protected $table = 'comisiones';
    protected $primaryKey = 'id_comision';


// una comisión pertenece a una carrera
//  tiene muchos  usuarios

    public function carrera():BelongsTo{
        return $this->belongsTo(Carrera::class, 'id_carrera', 'id_carrera');
    }




    public function usuario():HasMany
    {
        return $this->hasMany(Usuario::class, 'id_comision', 'id_comision');
    }

}
