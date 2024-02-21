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
    protected $fillable = ['id_dm','id_h_p_d_','id_aula','id_aula','dia','modulo_inicio','modulo_fin'];
    protected $table = 'disponibilidades';
    protected $primaryKey = 'id_disponibilidad';


    
//  Una disponibilidad pertenece a un docente.
    public function docenteMateria():BelongsTo{
        return $this->belongsTo(DocenteMateria::class,'id_dm','id_dm');
    }

    public function hpd():BelongsTo{
        return $this->belongsTo(HorarioPrevioDocente::class,'id_h_p_d','id_h_p_d');
    }

    public function comision():BelongsTo{
        return $this->belongsTo(Comision::class,'id_comision','id_comision');
    }

    public function aula():BelongsTo{
        return $this->belongsTo(aula::class,'id_aula','id_aula');
    }

     //  Una disponibilidad pertenece a una comision.
     public function horario():HasOne{
        return $this->hasOne(Horario::class,'id_disponibilidad','id_disponibilidad');
    }
}
