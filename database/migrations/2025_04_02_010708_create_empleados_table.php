<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla de empleados.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Información personal
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('dui', 10)->unique();
            $table->string('nit', 17)->unique()->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['masculino', 'femenino', 'otro'])->nullable();

            // Contacto
            $table->string('telefono', 20)->nullable();
            $table->string('correo', 150)->nullable();
            $table->string('direccion')->nullable();

            // Información laboral
            $table->string('cargo', 100); // Ej: Farmacéutico, Cajero, Repartidor
            $table->decimal('salario', 10, 2);
            $table->date('fecha_ingreso');
            $table->date('fecha_retiro')->nullable();

            // Relación opcional con un usuario del sistema
            $table->unsignedBigInteger('usuario_id')->nullable();

            // Estado
            $table->boolean('activo')->default(true);

            // Auditoría
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();

            // Timestamps de Laravel
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('usuario_id')->references('id')->on('usuarios')->nullOnDelete();
            $table->foreign('creado_por')->references('id')->on('usuarios')->nullOnDelete();
            $table->foreign('actualizado_por')->references('id')->on('usuarios')->nullOnDelete();
        });
    }

    /**
     * Revierte la migración eliminando la tabla de empleados.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
