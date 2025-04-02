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
        Schema::create('alquilerzonascomunes', function (Blueprint $table) {
            $table->integer('idAlquilerZonaComun')->primary();
            $table->date('FechaAlquiler');
            $table->integer('CantidadPersonas')->nullable();
            $table->integer('TotalPago');
            $table->dateTime('HoraLimite');
            $table->integer('idZonaComun')->index('fk_alquilerzonascomunes_zonacomun1_idx');
            $table->integer('idResidente')->index('fk_alquilerzonascomunes_residentes1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquilerzonascomunes');
    }
};
