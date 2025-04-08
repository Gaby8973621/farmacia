<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Información básica
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 150)->unique();
            $table->timestamp('email_verificado_en')->nullable();
            $table->string('contrasena');

            // Datos de contacto
            $table->string('telefono', 20)->nullable();
            $table->string('direccion')->nullable();

            // Información adicional
            $table->enum('genero', ['masculino', 'femenino', 'otro'])->nullable();
            $table->date('fecha_nacimiento')->nullable();

            // Roles dentro de la farmacia
            $table->enum('rol', ['cliente', 'farmaceutico', 'administrador'])->default('cliente');

            // Control de estado
            $table->boolean('activo')->default(true);

            // Auditoría básica (puede usarse con usuarios administrativos)
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();

            // Tokens y marcas de tiempo
            $table->rememberToken();
            $table->timestamps();

            // Relaciones opcionales con tabla de administradores
            $table->foreign('creado_por')->references('id')->on('usuarios')->nullOnDelete();
            $table->foreign('actualizado_por')->references('id')->on('usuarios')->nullOnDelete();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
