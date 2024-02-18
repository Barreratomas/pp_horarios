<?php

namespace Database\Factories;

use App\Models\Aula;
use App\Models\Comision;
use App\Models\Disponibilidad;
use App\Models\DocenteMateria;
use App\Models\Horario;
use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;


class HorarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $disponibilidad = Disponibilidad::inRandomOrder()->first();

        if ($disponibilidad === null) {
            // Si no hay disponibilidades,mamnejar excepcion
            return [];
        }
        

        
        return [
            'dia' => $disponibilidad->dia,
            'modulo_inicio' => $disponibilidad->modulo_inicio,
            'modulo_fin' => $disponibilidad->modulo_fin,
            'v_p' => $this->faker->randomElement(['V', 'P']),
            'id_disponibilidad' => $disponibilidad->id_disponibilidad,
            'aula' => Aula::inRandomOrder()->first()->id_aula,
            'comision' => $disponibilidad->id_comision,
        ];
    }
}

