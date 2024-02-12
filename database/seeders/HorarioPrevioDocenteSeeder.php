<?php

namespace Database\Seeders;

use App\Models\HorarioPrevioDocente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioPrevioDocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            HorarioPrevioDocente::factory()->count(10)->create();
        }
    }
}
