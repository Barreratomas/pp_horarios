<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Disponibilidad extends Model
{
    use HasFactory;
    protected $fillable = ['id_dm','dia','hora_inicio','hora_fin',];
    protected $table = 'disponibilidades';
    protected $primaryKey = 'id_disponibilidad';


    
//  Una disponibilidad pertenece a un docente.
    public function docenteMateria():BelongsTo{
        return $this->belongsTo(DocenteMateria::class,'id_dm','id_dm');
    }

    //  Una disponibilidad pertenece a una comision.
    public function hPD():BelongsTo{
        return $this->belongsTo(HorarioPrevioDocente::class,'id_h_p_d','id_h_p_d');
    }

    //  Una disponibilidad pertenece a una comision.
    public function comision():BelongsTo{
        return $this->belongsTo(Comision::class,'id_comision','id_comision');
    }

     //  Una disponibilidad pertenece a una comision.
     public function horario():HasOne{
        return $this->hasOne(Horario::class,'id_disponibilidad','id_disponibilidad');
    }
}
