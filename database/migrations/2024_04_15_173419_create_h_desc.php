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
        Schema::create('h_desc', function (Blueprint $table) {
            $table->string('h', 10)->primary(); // Definir el campo 'h' como varchar de longitud 10 y clave primaria
            $table->string('desc', 300);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_desc');
    }
};
