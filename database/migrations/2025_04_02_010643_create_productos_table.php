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
            $table->bigIncrements('id');

            // Información básica del producto
            $table->string('nombre', 150);
            $table->string('codigo_barra', 50)->unique()->nullable();
            $table->text('descripcion')->nullable();

            // Relación con la tabla de categorías (muchos a uno)
            $table->unsignedBigInteger('categoria_id')->nullable();

            // Relación con la tabla de proveedores (muchos a uno)
            $table->unsignedBigInteger('proveedor_id')->nullable();

            // Información de presentación (ej: caja, frasco, pastilla)
            $table->string('presentacion', 50)->nullable();

            // Precios
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('precio_venta', 10, 2);

            // Control de inventario
            $table->integer('stock');
            $table->integer('stock_minimo')->default(0);
            $table->integer('stock_maximo')->nullable();

            // Vencimiento
            $table->date('fecha_vencimiento')->nullable();

            // Estado del producto (activo/inactivo)
            $table->boolean('activo')->default(true);

            // Auditoría
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();

            $table->timestamps();

            // Llaves foráneas
            $table->foreign('categoria_id')->references('id')->on('categorias')->nullOnDelete();
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->nullOnDelete();
            $table->foreign('creado_por')->references('id')->on('usuarios')->nullOnDelete();
            $table->foreign('actualizado_por')->references('id')->on('usuarios')->nullOnDelete();
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
