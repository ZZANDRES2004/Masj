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
        Schema::create('usuario', function (Blueprint $table) {
            $table->integer('idUsuario')->unsigned()->primary()->autoIncrement();
            $table->string('PrimerNombre', 25);
            $table->string('SegundoNombre', 25)->nullable();
            $table->string('PrimerApellido', 25);
            $table->string('SegundoApellido', 30)->nullable();
            $table->string('NumeroCelular', 15);
            $table->string('CorreoElectronico', 40);
            $table->string('Contrasena', 64);
            $table->string('ConjuntoNombre', 25)->index('fk_usuario_conjunto1_idx');
            $table->date('FechaNacimiento');
            $table->enum('Estado', ['activo', 'inactivo']);
            $table->enum('Rol', ['propietario', 'arrendatario', 'guardia', 'administrador']);
            $table->string('TipoDocumento', 10);
            $table->integer('NumDocumento');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
