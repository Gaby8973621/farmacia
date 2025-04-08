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
        // Tabla de roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del rol (Ej. Admin, Empleado, etc.)
            $table->text('descripcion')->nullable(); // Descripción del rol
            $table->timestamps();
        });

        // Tabla intermedia para asociar usuarios con roles (relación muchos a muchos)
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Relación con roles
            $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade'); // Relación con usuarios
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
};
