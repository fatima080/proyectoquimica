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
        Schema::create('historial', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario');
            $table->string('id_producto', 10);
            $table->enum('movimiento', ['entrada', 'salida']);
            $table->integer('cantidad');
            $table->enum('motivo', ['adquisicion', 'consumo', 'regularizacion', 'accidente', 'otro']);
            $table->date('fecha')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial');
    }
};
