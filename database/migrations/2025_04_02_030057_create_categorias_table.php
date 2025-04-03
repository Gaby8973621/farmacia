<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->text('descripcion')->nullable();
            // Agrega 'created_at' y 'updated_at'
            $table->timestamps();
        });
    }

    public function down()
    {
        // Elimina la tabla si se hace rollback
        Schema::dropIfExists('categorias');
    }
};
