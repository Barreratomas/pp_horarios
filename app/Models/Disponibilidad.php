<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    
}
