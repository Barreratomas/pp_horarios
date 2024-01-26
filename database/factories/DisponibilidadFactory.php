<?php

namespace Database\Factories;

use App\Models\DocenteMateria;
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
          

        // Seleccionar un intervalo aleatorio
        $indiceInicio = rand(0, count($horasPermitidas) - 1);
        $indiceFin = rand(0, count($horasPermitidas) - 1);

        while ($indiceInicio >= $indiceFin) {
            $indiceFin = rand(0, count($horasPermitidas) - 1);
          }
          
          $horaInicio = $horasPermitidas[$indiceInicio];
          $horaFin = $horasPermitidas[$indiceFin];

        return [
            'id_dm' => DocenteMateria::inRandomOrder()->first()->id_dm,
            'dia' => $this->faker->randomElement(['lunes', 'martes', 'miercoles', 'jueves', 'viernes']),
            'hora_inicio' => $horaInicio,
            'hora_fin' => $horaFin,

        ];
    }
}
