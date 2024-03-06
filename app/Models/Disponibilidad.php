<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @OA\Schema(
 *     schema="Disponibilidad",
 *     title="Disponibilidad",
 *     description="Esquema del objeto Disponibilidad",
 *     @OA\Property(
 *          property="id_disponibilidad",
 *          type="integer",
 *          description="Id de la disponibilidad"
 *     ),
 *     @OA\Property(
 *          property="id_dm",
 *          type="integer",
 *          description="Id de la docente materia"
 *     ),
 *     @OA\Property(
 *          property="id_h_p_d",
 *          type="integer",
 *          description="Id del horario previo docente"
 *     ),
 *     @OA\Property(
 *          property="id_aula",
 *          type="integer",
 *          description="Id del aula"
 *     ),
 *     @OA\Property(
 *          property="dia",
 *          type="string",
 *          description="Dia de la disponibilidad"
 *     ),
 *     @OA\Property(
 *          property="modulo_inicio",
 *          type="integer",
 *          description="Modulo de inicio de la disponibilidad"
 *     ),
 *     @OA\Property(
 *          property="modulo_fin",
 *          type="integer",
 *          description="Modulo de fin de la disponibilidad"
 *     )
 * )
 */
class Disponibilidad extends Model
{
    use HasFactory;
    protected $fillable = ['id_dm','id_h_p_d','dia','modulo_inicio','modulo_fin'];
    protected $table = 'disponibilidades';
    protected $primaryKey = 'id_disponibilidad';



//  Una disponibilidad pertenece a un docente.
    public function docenteMateria():BelongsTo{
        return $this->belongsTo(DocenteMateria::class,'id_dm','id_dm');
    }

    public function hpd():BelongsTo{
        return $this->belongsTo(HorarioPrevioDocente::class,'id_h_p_d','id_h_p_d');
    }

   

     //  Una disponibilidad pertenece a una comision.
     public function horario():HasOne{
        return $this->hasOne(Horario::class,'id_disponibilidad','id_disponibilidad');
    }
}
