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
        Schema::create('quejas', function (Blueprint $table) {
            $table->integer('idQueja')->primary();
            $table->date('FechaQueja');
            $table->text('MotivoQueja');
            $table->integer('idResidente')->index('fk_quejas_residentes1_idx');
            $table->tinyInteger('EstadoQueja');
            $table->integer('idAdministrador');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quejas');
    }
};
