<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrera extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $table = 'carreras'; 

// Una carrera puede tener muchas comisiones asociadas
    public function comision():HasMany{
        return $this->hasMany(Comision::class, 'id_carrera', 'id_carrera');
    }
}
