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
        Schema::create('visitante', function (Blueprint $table) {
            $table->increments('idVisitante');
            $table->string('NombresVisitante', 40)->nullable(); // <- Ahora opcional
            $table->string('ApellidosVisitante', 40)->nullable();
            $table->string('TipoDocumento', 10)->nullable();
            $table->integer('NumDocumento')->nullable();
            $table->integer('idResidente')->unsigned()->nullable();
            $table->integer('idGuardia')->nullable();
            $table->string('apartamento');
            $table->time('hora_entrada')->nullable();
            $table->time('hora_salida')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitante');
    }
};
