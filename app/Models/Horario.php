<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Horario extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $table = 'horarios';

    //  Un horario pertenece a una comisión, a un docente y a un aula
    public function docenteMateria():BelongsTo{
        return $this->belongsTo(docenteMateria::class, 'id_dm','id_dm');
    }

    public function aula():BelongsTo{
        return $this->belongsTo(Aula::class, 'id_aula', 'id_aula');
    }

    public function comision():BelongsTo{
        return $this->belongsTo(Comision::class, 'id_comision','id_comision');
    }

}
