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
        Schema::table('alquilerzonascomunes', function (Blueprint $table) {
            $table->foreign(['idResidente'], 'fk_AlquilerZonasComunes_Residentes1')->references(['idResidente'])->on('residentes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['idZonaComun'], 'fk_AlquilerZonasComunes_ZonaComun1')->references(['idZonaComun'])->on('zonacomun')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alquilerzonascomunes', function (Blueprint $table) {
            $table->dropForeign('fk_AlquilerZonasComunes_Residentes1');
            $table->dropForeign('fk_AlquilerZonasComunes_ZonaComun1');
        });
    }
};
