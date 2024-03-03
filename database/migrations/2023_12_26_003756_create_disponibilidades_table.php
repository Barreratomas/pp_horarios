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
            $table->id('id_disponibilidad');
            $table->unsignedBigInteger('id_dm');
            $table->foreign('id_dm')->references('id_dm')->on('docentes_materias')->onDelete('cascade');
            
            $table->unsignedBigInteger('id_h_p_d');
            $table->foreign('id_h_p_d')->references('id_h_p_d')->on('horarios_previos_docentes')->onDelete('cascade');
            
            $table->enum('dia',['lunes','martes','miercoles','jueves','viernes']);
            $table->time('modulo_inicio');
            $table->time('modulo_fin');
            $table->timestamps();
           

           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disponibilidades');
    }
};
