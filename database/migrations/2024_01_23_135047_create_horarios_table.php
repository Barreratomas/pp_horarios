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
            $table->time('modulo_inicio');
            $table->time('modulo_fin');
            $table->string('v_p');
            $table->unsignedBigInteger('id_disponibilidad');
            $table->foreign('id_disponibilidad')->references('id_disponibilidad')->on('disponibilidades');
            $table->string('materia');
            $table->string('aula');
            $table->string('comision');
            $table->string('carrera');
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
