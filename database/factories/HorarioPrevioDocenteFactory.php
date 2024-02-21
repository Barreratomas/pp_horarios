<?php

namespace Database\Factories;

use App\Models\Docente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HorarioPrevioDocente>
 */
class HorarioPrevioDocenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
         // Generar una hora aleatoria entre 0 y 23 y minutos entre 0 y 59
         $hora = $this->faker->numberBetween(0, 23);
         $minutos = $this->faker->numberBetween(0, 59);
 
         // Formatear la hora y los minutos en un formato de 24 horas con dos dígitos para cada uno
         $horaFormateada = str_pad($hora, 2, '0', STR_PAD_LEFT);
         $minutosFormateados = str_pad($minutos, 2, '0', STR_PAD_LEFT);
 
         // Devolver la definición del modelo con la hora y los minutos en formato de 24 horas
         return [
             'dni_docente' => Docente::inRandomOrder()->first()->dni,
             'dia' => $this->faker->randomElement(['lunes','martes','miercoles','jueves','viernes']),
             'hora' => $horaFormateada . ':' . $minutosFormateados,
         ];
        
    }
}
