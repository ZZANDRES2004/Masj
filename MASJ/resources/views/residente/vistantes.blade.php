<?php
// Datos simulados de visitantes (puedes reemplazarlo luego por una consulta a BD)
$visitantes = [
    ['nombre' => 'Carlos Gómez', 'fecha_entrada' => '2024-04-01', 'hora_entrada' => '10:00', 'fecha_salida' => '2024-04-01', 'hora_salida' => '15:30'],
    ['nombre' => 'Lucía Ramírez', 'fecha_entrada' => '2024-03-30', 'hora_entrada' => '18:45', 'fecha_salida' => '2024-03-31', 'hora_salida' => '08:00'],
];
?>

<div class="form-card" id="visitantes-section">
    <h3 class="form-title">Historial de Visitantes</h3>

    <div id="lista-visitantes">
        <?php foreach ($visitantes as $visita): ?>
            <div class="visita-item">
                <br>    
                <p><strong>Nombre:</strong> <?= $visita['nombre'] ?></p>
                <br>
                <p><strong>Fecha de entrada:</strong> <?= $visita['fecha_entrada'] ?></p>
                <br>
                <p><strong>Hora de entrada:</strong> <?= $visita['hora_entrada'] ?></p>
                <br>
                <p><strong>Fecha de salida:</strong> <?= $visita['fecha_salida'] ?></p>
                <br>
                <p><strong>Hora de salida:</strong> <?= $visita['hora_salida'] ?></p>
                <hr>
            </div>
        <?php endforeach; ?>
    </div>
</div>
