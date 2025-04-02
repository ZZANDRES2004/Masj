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
        Schema::create('zonacomun', function (Blueprint $table) {
            $table->integer('idZonaComun')->primary();
            $table->string('TipoZona', 25);
            $table->enum('EstadoZona', ['Disponible', 'Ocupada']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zonacomun');
    }
};
