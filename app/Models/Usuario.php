<?php

namespace App\Models;

use App\Casts\PasswordCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','apellido','tipo','email','id_comision'];
    protected $table = 'usuarios'; 
    protected $primaryKey = 'dni';



    //   Un usuario pertenece a una comisión
    public function comision():BelongsTo{
        return $this->belongsTo(Comision::class, 'id_comision', 'id_comision');
    }

    public function carrera():BelongsTo{
        return $this->belongsTo(Comision::class, 'id_carrera', 'id_carrera');
    }

}
