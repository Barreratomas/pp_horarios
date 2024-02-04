<?php

namespace Database\Factories;

use App\Models\CambioDocente;
use App\Models\Docente;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CambioDocente>
 */
class CambioDocenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    
    {
        return [
            
            'docente_anterior' => Docente::inRandomOrder()->first()->dni,
            'docente_nuevo' => Docente::inRandomOrder()->first()->dni,
        ];
    }
}
