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

        $id_aula = $disponibilidad->docenteMateria->id_aula;

        $id_comision = $disponibilidad->docenteMateria->id_comision;
        
        $id_materia= $disponibilidad->docenteMateria->materia->id_materia;

        $id_carrera = $disponibilidad->docenteMateria->comision->carrera->id_carrera;

        return [
            'dia' => $disponibilidad->dia,
            'modulo_inicio' => $disponibilidad->modulo_inicio,
            'modulo_fin' => $disponibilidad->modulo_fin,
            'v_p' => $this->faker->randomElement(['V', 'P']),
            'id_disponibilidad' => $disponibilidad->id_disponibilidad,
            'materia'=>$id_materia,
            'aula' =>$id_aula,
            'comision' => $id_comision,
            'carrera' => $id_carrera,

        ];
    }
}

