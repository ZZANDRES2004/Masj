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
        Schema::table('visitante', function (Blueprint $table) {
            $table->foreign(['idResidente'], 'fk_Visitante_Residentes1')->references(['idResidente'])->on('residentes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitante', function (Blueprint $table) {
            $table->dropForeign('fk_Visitante_Residentes1');
        });
    }
};
