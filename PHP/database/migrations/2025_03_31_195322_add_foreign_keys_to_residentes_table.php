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
        Schema::table('residentes', function (Blueprint $table) {
            $table->foreign(['idApartamento'], 'fk_Residentes_Apartamentos')->references(['idApartamentos'])->on('apartamentos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['idResidente'], 'fk_Residentes_Usuario')->references(['idUsuario'])->on('usuario')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residentes', function (Blueprint $table) {
            $table->dropForeign('fk_Residentes_Apartamentos');
            $table->dropForeign('fk_Residentes_Usuario');
        });
    }
};
