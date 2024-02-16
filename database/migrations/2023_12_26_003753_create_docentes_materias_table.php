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
            $table->foreign('dni_docente')->references('dni')->on('docentes');
            $table->unsignedBigInteger('id_materia');
            $table->foreign('id_materia')->references('id_materia')->on('materias');
            $table->unsignedBigInteger('modulos_semanales');
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
