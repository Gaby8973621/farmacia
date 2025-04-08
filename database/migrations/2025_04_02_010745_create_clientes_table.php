<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla de clientes.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Información personal
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('dui', 10)->unique()->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['masculino', 'femenino', 'otro'])->nullable();

            // Contacto
            $table->string('telefono', 20)->nullable();
            $table->string('correo', 150)->nullable();
            $table->string('direccion')->nullable();

            // Información adicional
            $table->integer('puntos')->default(0); // Para sistema de lealtad
            $table->boolean('activo')->default(true);

            // Auditoría
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();

            $table->timestamps();

            // Llaves foráneas
            $table->foreign('creado_por')->references('id')->on('usuarios')->nullOnDelete();
            $table->foreign('actualizado_por')->references('id')->on('usuarios')->nullOnDelete();
        });
    }

    /**
     * Revierte la migración eliminando la tabla de clientes.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
