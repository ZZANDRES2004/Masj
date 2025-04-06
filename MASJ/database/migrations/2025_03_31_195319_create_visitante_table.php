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
            $table->integer('idVisitante')->primary();
            $table->string('NombresVisitante', 40);
            $table->string('ApellidosVisitante', 40);
            $table->string('TipoDocumento', 10);
            $table->integer('NumDocumento');
            $table->integer('idResidente')->unsigned();
            $table->integer('idGuardia');
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
