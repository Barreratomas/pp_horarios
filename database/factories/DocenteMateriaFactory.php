<?php

namespace Database\Factories;

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
    $materia = Materia::inRandomOrder()->first();

    return [
        'dni_docente' => Docente::inRandomOrder()->first()->dni,
        'id_materia' => $materia->id_materia
    ];
}

}
