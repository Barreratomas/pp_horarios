<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioPrevioDocente extends Model
{
    use HasFactory;

    protected $table = 'horarios_previos_docentes'; 

    protected $fillable = ['dni_docente', 'dia', 'hora']; 

    // Relación con el modelo Docente
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'dni_docente', 'dni');
    }

}
