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
            $table->id();
            $table->string('nombre'); // Nombre del usuario
            $table->string('direccion'); // Dirección del usuario
            $table->string('telefono'); // Teléfono del usuario
            $table->string('email')->unique(); // Correo electrónico único
            $table->boolean('activo')->default(true); // Estado activo/inactivo
            $table->timestamps(); // Tiempos de creación y actualización
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
