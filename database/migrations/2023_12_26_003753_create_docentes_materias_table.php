<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('docentes_materias', function (Blueprint $table) {
            $table->id("id_dm");
            
            $table->unsignedBigInteger('dni_docente');
        $table->foreign('dni_docente')->references('dni')->on('docentes')->onDelete('cascade');
        
        $table->unsignedBigInteger('id_materia');
        $table->foreign('id_materia')->references('id_materia')->on('materias')->onDelete('cascade');
        
        $table->unsignedBigInteger('id_comision');
        $table->foreign('id_comision')->references('id_comision')->on('comisiones')->onDelete('cascade');
        
        $table->unsignedBigInteger('id_aula');
        $table->foreign('id_aula')->references('id_aula')->on('aulas')->onDelete('cascade');

            


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes_materias');
    }
};
