<?php

namespace Database\Factories;

use App\Models\Aula;
use App\Models\Docente;
use App\Models\Materia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocenteMateria>
 */
class DocenteMateriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
   {
    // Ajusta estos valores según tus necesidades
    $dniDocente = Docente::inRandomOrder()->first()->dni;
    $idMateria = Materia::inRandomOrder()->first()->id_materia;

    return [
        'dni_docente' => $dniDocente,
        'id_materia' => $idMateria,
    ];
}

}
