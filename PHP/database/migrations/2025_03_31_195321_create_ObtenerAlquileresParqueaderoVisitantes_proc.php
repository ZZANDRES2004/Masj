<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerAlquileresParqueaderoVisitantes`()
BEGIN
    SELECT 
        a.idAlquilerParqueadero, 
        v.NombresVisitante, 
        v.ApellidosVisitante, 
        p.idBahia, 
        a.FechaIngreso, 
        a.TotalPago
    FROM 
        registro_de_parqueadero a
    INNER JOIN 
        Visitante v ON a.idVisitante = v.idVisitante
    INNER JOIN 
        Parqueadero p ON a.idBahia = p.idBahia;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ObtenerAlquileresParqueaderoVisitantes");
    }
};
