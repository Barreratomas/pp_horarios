<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CambioDocente;
use App\Models\Carrera;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AulaSeeder::class,
            DocenteSeeder::class,
            CarreraSeeder::class,
            MateriaSeeder::class,
            ComisionSeeder::class,
            UsuarioSeeder::class,
            CambioDocenteSeeder::class,
            DocenteMateriaSeeder::class,
            HorarioPrevioDocenteSeeder::class,
            DisponibilidadSeeder::class,
            HorarioSeeder::class
        ]);
    }
}
