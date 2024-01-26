<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Aula extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $table = 'aulas';

    // Un aula puede tener muchos horarios 
    public function horario():HasMany{
        return $this->hasMany(Horario::class,'id_aula','id_aula');

    }
}
