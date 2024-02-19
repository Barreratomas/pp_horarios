<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DocenteMateria extends Model
{
    use HasFactory;
    protected $fillable = ['dni_docente','id_materia',];
    protected $table = 'docentes_materias'; 
    protected $primaryKey = 'id_dm';



    public function docente():BelongsTo{
        return $this->belongsTo(Docente::class,'dni_docente','dni');
    }
    public function materia():BelongsTo{
    return $this->belongsTo(Materia::class,'id_materia','id_materia');
    }

   

// DocenteMateria puede tener varias disponibilidades asociadas.
    public function disponibilidad():HasMany{
    return $this->hasMany(disponibilidad::class,'id_dm','id_dm');

    }      


    

}
