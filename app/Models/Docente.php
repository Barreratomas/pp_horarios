<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @OA\Schema(
 *     schema="Docente",
 *     title="Docente",
 *     description="Esquema del objeto Docente",
 *     @OA\Property(
 *          property="dni",
 *          type="integer",
 *          description="DNI del docente"
 *     ),
 *     @OA\Property(
 *          property="nombre",
 *          type="string",
 *          description="Nombre del docente"
 *     ),
 *     @OA\Property(
 *          property="apellido",
 *          type="string",
 *          description="Apellido del docente"
 *     ),
 *     @OA\Property(
 *          property="email",
 *          type="string",
 *          description="Email del docente"
 *     )
 * )
 */
class Docente extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'apellido', 'email'];
    protected $table = 'docentes';
    protected $primaryKey = 'dni';


    // Un docente puede tener muchos cambios (anterior y nuevo)
    // dar muchas materias y tener varias disponibilidades asociadas
    public function docenteMateria():HasMany{
        return $this->hasMany(DocenteMateria::class,'dni_docente','dni');

    }

    public function cambioDocenteAnterior():HasMany{
        return $this->hasMany(CambioDocente::class, 'docente_anterior', 'dni');
    }
    public function cambioDocenteNuevo():HasMany{
        return $this->hasMany(CambioDocente::class, 'docente_nuevo', 'dni');
    }


    public function horarioPrevioDocente():HasMany{
        return $this->hasMany(HorarioPrevioDocente::class, 'dni_docente', 'dni');
    }

}
