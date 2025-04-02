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
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->foreign(['idBahia'], 'fk_Vehiculos_Parqueadero1')->references(['idBahia'])->on('parqueadero')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['idResidente'], 'fk_Vehiculos_Residentes1')->references(['idResidente'])->on('residentes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->dropForeign('fk_Vehiculos_Parqueadero1');
            $table->dropForeign('fk_Vehiculos_Residentes1');
        });
    }
};
