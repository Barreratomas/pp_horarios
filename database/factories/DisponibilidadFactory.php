<?php

namespace Database\Factories;

use App\Models\Aula;
use App\Models\Comision;
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
        $horariosInicioPermitidos = ['19:20', '20:00', '20:40', '21:30', '22:10', '22:50'];
        $indiceInicio = array_rand($horariosInicioPermitidos);
        $horaInicio = $horariosInicioPermitidos[$indiceInicio];

        // Calcular el horario de fin
        $horaFin = date('H:i', strtotime("$horaInicio + 40 minutes"));

          $horarioPrevioDocente = HorarioPrevioDocente::inRandomOrder()->first();

          return [
            'id_dm' => DocenteMateria::inRandomOrder()->first()->id_dm,
            'id_h_p_d' => $horarioPrevioDocente->id_h_p_d,
            'dia' => $horarioPrevioDocente->dia,
            'modulo_inicio' => $horaInicio,
            'modulo_fin' => $horaFin,
        ];
    }
}
