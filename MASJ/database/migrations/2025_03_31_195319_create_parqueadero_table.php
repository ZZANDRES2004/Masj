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
        Schema::create('parqueadero', function (Blueprint $table) {
            $table->integer('idBahia')->primary();
            $table->text('Novedad')->nullable();
            $table->enum('Estado', ['Ocupado', 'Desocupado']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parqueadero');
    }
};
