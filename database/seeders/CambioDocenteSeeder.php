<?php

namespace Database\Seeders;

use App\Models\CambioDocente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CambioDocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CambioDocente::factory()->count(10)->create();

    }
}
