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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre completo del cliente
            $table->string('telefono')->nullable(); // Teléfono del cliente (opcional)
            $table->string('email')->nullable()->unique(); // Correo electrónico del cliente (opcional)
            $table->string('direccion')->nullable(); // Dirección del cliente (opcional)
            $table->timestamps(); // Fechas de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
