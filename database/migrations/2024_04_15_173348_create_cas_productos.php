<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cas_productos', function (Blueprint $table) {
            $table->string('id', 10)->primary(); // Definir el campo 'id' como varchar de longitud 10 y clave primaria
            $table->string('cas', 100);
            $table->string('nombre', 100);
            $table->string('fds', 500)->nullable();
            $table->enum('estado', ['liquido', 'solido']);
            $table->enum('tipo', ['base', 'acido', 'otro']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cas_productos');
    }
};
