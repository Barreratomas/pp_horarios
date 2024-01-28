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
        Schema::create('comisiones', function (Blueprint $table) {
            $table->id('id_comision');
            $table->integer('anio');
            $table->integer('division');
            $table->unsignedBigInteger('id_carrera'); // Usar unsignedBigInteger para claves foráneas
            $table->foreign('id_carrera', 'fk_comisiones_carrera')->references('id_carrera')->on('carreras');
            $table->integer('capacidad');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comisiones');
    }
};