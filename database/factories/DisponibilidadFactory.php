<?php

namespace Database\Factories;

use App\Models\DocenteMateria;
use App\Models\HorarioPrevioDocente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Disponibilidad>
 */
class DisponibilidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mpdulosPermitidos = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
          ];
          

          $indices = array_rand($mpdulosPermitidos, 2);

          $indiceInicio = $indices[0];
          $indiceFin = $indices[1];
          
          $moduloInicio = $mpdulosPermitidos[$indiceInicio];
          $moduloFin = $mpdulosPermitidos[$indiceFin];

          $horarioPrevioDocente = HorarioPrevioDocente::inRandomOrder()->first();

          return [
            'id_dm' => DocenteMateria::inRandomOrder()->first()->id_dm,
            'id_h_p_d' => $horarioPrevioDocente->id_h_p_d,
            'dia' => $horarioPrevioDocente->dia,
            'modulo_inicio' => $moduloInicio,
            'modulo_fin' => $moduloFin,
        ];
    }
}
