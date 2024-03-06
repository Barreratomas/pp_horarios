<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @OA\Schema(
 *     schema="Horario",
 *     title="Horario",
 *     description="Esquema del objeto Horario",
 *     @OA\Property(
 *          property="id_horario",
 *          type="integer",
 *          description="ID del horario"
 *     ),
 *     @OA\Property(
 *          property="dia",
 *          type="string",
 *          description="Dia de la semana"
 *     ),
 *     @OA\Property(
 *          property="hora_inicio",
 *          type="time",
 *          description="Hora de inicio"
 *     ),
 *     @OA\Property(
 *          property="hora_fin",
 *          type="time",
 *          description="Hora de fin"
 *     ),
 *     @OA\Property(
 *          property="v_p",
 *          type="boolean",
 *          description="Vigente o Pasado"
 *     ),
 *     @OA\Property(
 *          property="id_dm",
 *          type="integer",
 *          description="ID de la relacion docente materia"
 *     ),
 *     @OA\Property(
 *          property="id_aula",
 *          type="integer",
 *          description="ID del aula"
 *     ),
 *     @OA\Property(
 *          property="id_comision",
 *          type="integer",
 *          description="ID de la comision"
 *     )
 * )
 */
class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['dia','modulo_inicio','modulo_fin','v_p','id_disponibilidad','materia','aula','anio','division','carrera'];
    protected $table = 'horarios';
    protected $primaryKey = 'id_horario';

    //  Un horario pertenece a una disponibilidad
    public function disponibilidad():BelongsTo{
        return $this->belongsTo(Disponibilidad::class, 'id_disponibilidad','id_disponibilidad');
    }



}
