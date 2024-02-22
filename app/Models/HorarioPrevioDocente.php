<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
