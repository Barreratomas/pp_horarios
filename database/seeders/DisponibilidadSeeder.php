<?php

namespace Database\Seeders;

use App\Models\Disponibilidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisponibilidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Disponibilidad::factory()->count(10)->create();

    }
}
