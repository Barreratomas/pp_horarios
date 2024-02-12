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
        $horasPermitidas = [
            '19:20:00',
            '20:00:00',
            '20:40:00',
            '21:20:00',
            '21:30:00',
            '22:10:00',
            '22:50:00',
            '23:30:00',
          ];
          

          $indices = array_rand($horasPermitidas, 2);

          $indiceInicio = $indices[0];
          $indiceFin = $indices[1];
          
          $horaInicio = $horasPermitidas[$indiceInicio];
          $horaFin = $horasPermitidas[$indiceFin];

          $horarioPrevioDocente = HorarioPrevioDocente::inRandomOrder()->first();

          return [
            'id_dm' => DocenteMateria::inRandomOrder()->first()->id_dm,
            'id_h_p_d' => $horarioPrevioDocente->id_h_p_d,
            'dia' => $horarioPrevioDocente->dia,
            'hora_inicio' => $horaInicio,
            'hora_fin' => $horaFin,
        ];
    }
}
