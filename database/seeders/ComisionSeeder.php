<?php

namespace Database\Seeders;

use App\Models\Comision;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        Comision::factory()->count(2)->create();
    }
}
