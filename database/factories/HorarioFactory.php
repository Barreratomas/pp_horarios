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

        $id_aula = $disponibilidad->docenteMateria->aula->nombre;

        $comision = $disponibilidad->docenteMateria->comision;
        
        $id_materia= $disponibilidad->docenteMateria->materia->nombre;

        $id_carrera = $disponibilidad->docenteMateria->comision->carrera->id_carrera;

        return [
            'dia' => $disponibilidad->dia,
            'modulo_inicio' => $disponibilidad->modulo_inicio,
            'modulo_fin' => $disponibilidad->modulo_fin,
            'v_p' => $this->faker->randomElement(['V', 'P']),
            'id_disponibilidad' => $disponibilidad->id_disponibilidad,
            'materia'=>$id_materia,
            'aula' =>$id_aula,
            'anio' => $comision->anio,
            'division' => $comision->division,
            'carrera' => $id_carrera,

        ];
    }
}

