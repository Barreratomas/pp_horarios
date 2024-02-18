<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materia>
 */
class MateriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->randomElement([
                'Comunicación', 'UDI 1', 'Matemática', 'Física Aplicada a las Tecnologías de la Informacion', 'Administración', 'Inglés Técnico', 'Arquitectura de las Computadoras', 'Lógica y Programación', 'Infraestructura de Redes 1', 'Problemáticas Socio Contemporáneas', 'UDI 2', 'Estadística', 'Innovación y Desarrollo Emprendedor', 'Sistemas Operativos', 'Algoritmos y Estructura de Datos', 'Bases de Datos', 'Infraestructura de Redes 2', 'Práctica Profesionalizante 1', 'Etica y Responsabilidad Social', 'Derecho y Legislación laboral', 'Administración de Bases de Datos', 'Seguridad de los Sistemas', 'Integridad y Migración de Datos', 'Administración de Sistemas Operativos y Red', 'Práctica Profesionalizante 2',
                'Tecnología de la Información', 'Lógica y Estructura de Datos', 'Ingeniería de Software', 'Programación 1', 'Programación 2', 'Redes y Comunicación', 'Gestión de Proyectos de Software',
                'Psicosociología de las Organizaciones', 'Modelos de Negocios', 'Arquitectura de las Computadoras', 'Gestión de Software 1', 'Gestión de Software 2', 'Análisis de Sistemas Organizacionales', 'Estrategias de Negocios', 'Desarrollo de Sistemas', 'Desarrollo de Sistemas Web', 'Redes y Comunicaciones', 'Sistema de Información Organizacional', 'Desarrollo de Sistemas Web']),

            "modulos_semanales"=> $this->faker->numberBetween(1, 6)
           
        ];
    }
}
