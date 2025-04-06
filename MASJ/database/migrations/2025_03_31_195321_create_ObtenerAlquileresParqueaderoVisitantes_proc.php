<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; // Asegúrate de importar DB

return new class extends Migration {
    public function up(): void {
        // Añade esta línea para borrar el procedimiento si existe
        DB::unprepared('DROP PROCEDURE IF EXISTS ObtenerAlquileresParqueaderoVisitantes');

        // Manten tu código original para crear el procedimiento
        DB::unprepared('
            CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerAlquileresParqueaderoVisitantes`()
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
            END
        ');
    }

    public function down(): void {
        // Asegúrate de que el método down también lo borre
        DB::unprepared('DROP PROCEDURE IF EXISTS ObtenerAlquileresParqueaderoVisitantes');
    }
};