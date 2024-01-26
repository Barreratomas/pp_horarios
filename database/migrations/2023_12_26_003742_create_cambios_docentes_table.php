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
        Schema::create('cambios_docentes', function (Blueprint $table) {
            $table->increments('id_cambio');
            $table->integer('docente_anterior');
            $table->integer('docente_nuevo');
            $table->foreign('docente_anterior')->references('dni')->on('docentes');
            $table->foreign('docente_nuevo')->references('dni')->on('docentes');
            $table->time('fecha_cambio');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cambios_docentes');
    }
};
