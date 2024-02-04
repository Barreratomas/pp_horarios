<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];
    protected $table = 'materias'; 
    protected $primaryKey = 'id_materia';


    //  Una materia puede ser enseñada por muchos docentes
    public function DocenteMateria():HasMany{
        return $this->hasMany(DocenteMateria::class,'id_materia','id_materia');

    }

}
