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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id('id_horario');
            $table->enum('dia',['lunes','martes','miercoles','jueves','viernes']);
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('v/p');
            $table->unsignedBigInteger('id_dm');
            $table->unsignedBigInteger('id_aula');
            $table->unsignedBigInteger('id_comision');
            $table->foreign('id_dm')->references('id_dm')->on('docentes_materias');
            $table->foreign('id_aula')->references('id_aula')->on('aulas');
            $table->foreign('id_comision')->references('id_comision')->on('comisiones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
