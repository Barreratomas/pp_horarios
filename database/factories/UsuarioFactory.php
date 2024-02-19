<?php

namespace Database\Factories;

use App\Models\Carrera;
use App\Models\Comision;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dni' => $this->faker->unique()->randomNumber(8),
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'tipo' => $this->faker->randomElement(['alumno', 'docente', 'admin', 'visitante']),
            'email' => $this->faker->unique()->safeEmail,
            'id_carrera' => Carrera::inRandomOrder()->first()->id_carrera,
            'id_comision' => Comision::inRandomOrder()->first()->id_comision,
        ];
    }
}
