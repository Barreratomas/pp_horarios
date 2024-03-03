<?php

namespace Database\Seeders;

use App\Models\DocenteMateria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocenteMateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocenteMateria::factory()->count(10)->create();

    }
}
