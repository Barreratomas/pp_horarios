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
        Schema::create('horarios_previos_docentes', function (Blueprint $table) {
            $table->id('id_h_p_d');
            $table->unsignedBigInteger('dni_docente'); // Ajustar el tipo de dato según la longitud del DNI
            $table->foreign('dni_docente')->references('dni')->on('docentes');
            $table->string('dia');
            $table->time('hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_previos_docentes');
    }
};
