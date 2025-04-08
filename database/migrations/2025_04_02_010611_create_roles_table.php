<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla de roles.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Nombre del rol (ej: Administrador, Farmacéutico, Cliente)
            $table->string('nombre', 50)->unique();

            // Slug para uso interno (ej: admin, farmaceutico, cliente)
            $table->string('slug', 50)->unique();

            // Descripción opcional del rol
            $table->string('descripcion')->nullable();

            // Estado del rol (activo/inactivo)
            $table->boolean('activo')->default(true);

            // Auditoría (si hay control de usuarios que crean/actualizan roles)
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();

            $table->timestamps();

            // Llaves foráneas si se desea rastrear quién creó o actualizó
            $table->foreign('creado_por')->references('id')->on('usuarios')->nullOnDelete();
            $table->foreign('actualizado_por')->references('id')->on('usuarios')->nullOnDelete();
        });
    }

    /**
     * Revierte la migración eliminando la tabla de roles.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
