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
        DB::unprepared('DROP PROCEDURE IF EXISTS ObtenerCorrespondenciaPorFecha');
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerCorrespondenciaPorFecha`(IN `fecha_ingreso` DATE)
BEGIN
    SELECT 
        CONCAT(u2.PrimerNombre, ' ', u2.SegundoNombre, ' ', u2.PrimerApellido, ' ', u2.SegundoApellido) AS NombreGuardia,
        c.TipoPaquete, 
        c.FechaIngreso, 
        c.FechaEntrega,
        CONCAT(u1.PrimerNombre, ' ', u1.SegundoNombre, ' ', u1.PrimerApellido, ' ', u1.SegundoApellido) AS NombreResidente
    FROM 
        correspondencia c
    INNER JOIN 
        residentes r ON c.idResidente = r.idResidente
    INNER JOIN 
        usuario u1 ON r.idResidente = u1.idUsuario
    INNER JOIN 
        usuario u2 ON u2.idUsuario = c.idGuardia  
    WHERE 
        c.FechaIngreso BETWEEN DATE_SUB(fecha_ingreso, INTERVAL 1 DAY) AND DATE_ADD(fecha_ingreso, INTERVAL 1 DAY);
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ObtenerCorrespondenciaPorFecha');
        DB::unprepared("DROP PROCEDURE IF EXISTS ObtenerCorrespondenciaPorFecha");
    }
};
