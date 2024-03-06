<?php

namespace App\Models;

use App\Casts\PasswordCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     schema="Usuario",
 *     title="Usuario",
 *     description="Esquema del objeto Usuario",
 *     @OA\Property(
 *          property="dni",
 *          type="integer",
 *          description="DNI del usuario"
 *     ),
 *     @OA\Property(
 *          property="nombre",
 *          type="string",
 *          description="Nombre del usuario"
 *     ),
 *     @OA\Property(
 *          property="apellido",
 *          type="string",
 *          description="Apellido del usuario"
 *     ),
 *     @OA\Property(
 *          property="tipo",
 *          type="string",
 *          description="Tipo de usuario"
 *     ),
 *     @OA\Property(
 *          property="email",
 *          type="string",
 *          description="Email del usuario"
 *     ),
 *     @OA\Property(
 *          property="id_comision",
 *          type="integer",
 *          description="ID de la comision a la que pertenece el usuario"
 *     )
 * )
 */
class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','apellido','tipo','email','anio','id_carrera','id_comision'];
    protected $table = 'usuarios';
    protected $primaryKey = 'dni';



    //   Un usuario pertenece a una comisión
    public function comision():BelongsTo{
        return $this->belongsTo(Comision::class, 'id_comision', 'id_comision');
    }

    public function carrera():BelongsTo{
        return $this->belongsTo(Carrera::class, 'id_carrera', 'id_carrera');
    }

}
