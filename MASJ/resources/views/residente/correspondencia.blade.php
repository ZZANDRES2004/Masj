<?php
$correspondencias = [
    [
        'descripcion' => 'Carta del banco',
        'estado' => 'No entregado',
        'fecha_llegada' => '2025-04-01',
        'hora_llegada' => '10:30',
        'fecha_entrega' => '',
        'hora_entrega' => '',
        'novedad' => ''
    ],
    [
        'descripcion' => 'Paquete de Amazon',
        'estado' => 'Entregado',
        'fecha_llegada' => '2025-03-30',
        'hora_llegada' => '16:00',
        'fecha_entrega' => '2025-03-30',
        'hora_entrega' => '18:15',
        'novedad' => 'Caja ligeramente dañada'
    ]
];
?>

<div class="form-card" id="correspondencia-section">
    <h3 class="form-title">Correspondencia Recibida</h3>

    <?php foreach ($correspondencias as $index => $item): ?>
        <div class="correspondencia-item">
            <br>
            <p><strong>Descripción:</strong> <?= $item['descripcion']; ?></p>
            <br>
            <p><strong>Estado:</strong> <?= $item['estado']; ?></p>
            <br>
            <p><strong>Fecha de llegada:</strong> <?= $item['fecha_llegada']; ?> a las <?= $item['hora_llegada']; ?></p>
            <br>

            <?php if ($item['estado'] === 'Entregado'): ?>
                <p><strong>Fecha de entrega:</strong> <?= $item['fecha_entrega']; ?> a las <?= $item['hora_entrega']; ?></p>
            <?php endif; ?>
            

            <div class="novedad-section">
                <br>
                <button class="btn btn-warning toggle-novedad" data-index="<?= $index ?>">Registrar Novedad</button>
                <br>

                <div class="novedad-form" id="novedad-form-<?= $index ?>" style="display: none; margin-top: 10px;">
                    <textarea class="form-control" rows="3" placeholder="Describe la novedad aquí..." style="width: 100%;"><?= $item['novedad']; ?></textarea>
                    <div style="margin-top: 5px;">
                        <button class="btn btn-primary enviar-novedad" data-index="<?= $index ?>">Enviar</button>
                        <button class="btn btn-secondary cancelar-novedad" data-index="<?= $index ?>">Cancelar</button>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    <?php endforeach; ?>
</div>
