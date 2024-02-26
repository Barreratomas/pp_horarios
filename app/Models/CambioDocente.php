<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @OA\Schema(
 *     schema="CambioDocente",
 *     title="CambioDocente",
 *     description="Esquema del objeto CambioDocente",
 *     @OA\Property(
 *          property="id_cambio",
 *          type="integer",
 *          description="Id del cambio de docente"
 *     ),
 *     @OA\Property(
 *          property="docente_anterior",
 *          type="string",
 *          description="DNI del docente anterior"
 *     ),
 *     @OA\Property(
 *          property="docente_nuevo",
 *          type="string",
 *          description="DNI del docente nuevo"
 *     )
 * )
 */
class CambioDocente extends Model
{
    use HasFactory;
    protected $fillable = ['docente_anterior','docente_nuevo'];
    protected $table = 'cambios_docentes';
    protected $primaryKey = 'id_cambio';



    // Un cambio de docente pertenece a un docente anterior y a un docente nuevo
    public function docenteAnterior():BelongsTo{
        return $this->belongsTo(Docente::class, 'docente_anterior', 'dni');
    }

    public function docenteNuevo():BelongsTo{
        return $this->belongsTo(Docente::class, 'docente_nuevo', 'dni');
    }

}
