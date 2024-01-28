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
            'dia' => $this->faker->randomElement(["lunes", "martes", "miercoles", "jueves", "viernes"]),
            'hora_inicio' => $disponibilidad->hora_inicio,
            'hora_fin' => $disponibilidad->hora_fin,
            'v/p' => $this->faker->randomElement(['V', 'P']),
            'id_dm' => DocenteMateria::inRandomOrder()->first()->id_dm,
            'id_aula' => Aula::inRandomOrder()->first()->id_aula,
            'id_comision' => Comision::inRandomOrder()->first()->id_comision,
        ];
    }
}

