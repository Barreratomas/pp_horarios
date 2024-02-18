<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['dia','hora_inicio','hora_fin','v_p','id_dm','id_aula','id_comision'];
    protected $table = 'horarios';
    protected $primaryKey = 'id_horario';

    //  Un horario pertenece a una disponibilidad
    public function disponibilidad():BelongsTo{
        return $this->belongsTo(Disponibilidad::class, 'id_disponibilidad','id_disponibilidad');
    }

   

}
