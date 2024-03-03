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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id("dni");
            $table->string('nombre');
            $table->string('apellido');
            $table->string('tipo');
            $table->string('email');
            $table->unsignedBigInteger('id_carrera')->nullable(); // Definir como nullable
            $table->foreign('id_carrera')->references('id_carrera')->on('carreras')->onDelete('cascade');
            $table->unsignedBigInteger('id_comision')->nullable(); // Definir como nullable
            $table->foreign('id_comision')->references('id_comision')->on('comisiones')->onDelete('cascade');
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
