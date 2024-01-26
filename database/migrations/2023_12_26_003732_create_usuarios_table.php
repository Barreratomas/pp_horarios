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
            $table->integer("dni")->primary();
            $table->string('nombre');
            $table->string('apellido');
            $table->enum('tipo', ['alumno', 'docente', 'admin', 'visitante']);
            $table->string('email');
            $table->integer('id_comision');
            $table->foreign('id_comision')->references('id_comision')->on('comisiones');
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
