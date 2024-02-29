<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="HorarioPrevioDocente",
 *     title="HorarioPrevioDocente",
 *     description="Esquema del objeto HorarioPrevioDocente",
 *     @OA\Property(
 *          property="id_h_p_d",
 *          type="integer",
 *          description="ID del horario previo del docente"
 *     ),
 *     @OA\Property(
 *          property="dni_docente",
 *          type="string",
 *          description="DNI del docente"
 *     ),
 *     @OA\Property(
 *          property="dia",
 *          type="string",
 *          description="Dia de la semana"
 *     ),
 *     @OA\Property(
 *          property="hora",
 *          type="time",
 *          description="Hora del horario"
 *     )
 * )
 */
class HorarioPrevioDocente extends Model
{
    use HasFactory;

    protected $table = 'horarios_previos_docentes';

    protected $fillable = ['dni_docente', 'dia', 'hora'];
    protected $primaryKey = 'id_h_p_d';


    public function disponibilidad():HasMany{
        return $this->hasMany(Disponibilidad::class, 'id_h_p_d','id_h_p_d');
    }


    // Relación con el modelo Docente
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'dni_docente', 'dni');
    }



}
