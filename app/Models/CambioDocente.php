<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CambioDocente extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'cambios_docentes'; 


    // Un cambio de docente pertenece a un docente anterior y a un docente nuevo
    public function docenteAnterior():BelongsTo{
        return $this->belongsTo(Docente::class, 'docente_anterior', 'dni');
    }

    public function docenteNuevo():BelongsTo{
        return $this->belongsTo(Docente::class, 'docente_nuevo', 'dni');
    }
    
}
