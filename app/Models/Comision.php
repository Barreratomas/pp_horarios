<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comision extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $table = 'comisiones';
    protected $primaryKey = 'id_comision';
 

// una comisión pertenece a una carrera
//  tiene muchos horarios asociados y tiene varios usuarios 

    public function carrera():BelongsTo{
        return $this->belongsTo(Carrera::class, 'id_carrera', 'id_carrera');
    }

    public function horario():HasMany{
        return $this->hasMany(Horario::class,'id_comision','id_comision');

    }


    public function usuarios():HasMany
    {
        return $this->hasMany(Usuario::class, 'id_comision', 'id_comision');
    }

}
