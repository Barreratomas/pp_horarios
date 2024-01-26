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
        Schema::create('disponibilidades', function (Blueprint $table) {
            $table->increments('id_disponibilidad');
            $table->integer('id_dm');
            $table->foreign('id_dm')->references('id_dm')->on('docentes_materias');
            $table->enum('dia',['lunes','martes','miercoles','jueves','viernes']);
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();
            $table->unique(['id_disponibilidad', 'id_dm']);

           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disponibilidades');
    }
};
