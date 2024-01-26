<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disponibilidad extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'disponibilidades';
    
    
//  Una disponibilidad pertenece a un docente.
    public function docenteMateria():BelongsTo{
        return $this->belongsTo(DocenteMateria::class,'id_dm','id_dm');
    }
    
}
