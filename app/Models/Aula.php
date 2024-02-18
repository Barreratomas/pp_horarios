<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'capacidad', 'tipo_aula'];
    protected $table = 'aulas';
    protected $primaryKey = 'id_aula';


    // Un aula puede tener muchos horarios 
    public function docenteMateria():HasMany{
        return $this->hasMany(DocenteMateria::class,'id_aula','id_aula');

    }
}
