<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración para crear la tabla de productos.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración eliminando la tabla de productos.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
