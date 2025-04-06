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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->integer('idVehiculo', true);
            $table->string('PlacaVehiculo', 6);
            $table->string('MarcaVehiculo', 15)->nullable();
            $table->string('ModeloVehiculo', 25)->nullable();
            $table->integer('idBahia')->index('fk_vehiculos_parqueadero1_idx');
            $table->integer('idResidente')->unsigned();
            $table->integer('idVisitante')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
