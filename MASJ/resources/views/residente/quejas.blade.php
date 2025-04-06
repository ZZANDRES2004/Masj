<?php
$quejas = [
    ['fecha' => '2023-10-26', 'descripcion' => 'Ruido excesivo por la noche.', 'estado' => 'En proceso'],
    ['fecha' => '2023-10-20', 'descripcion' => 'Problemas con el ascensor.', 'estado' => 'Finalizado'],
    ['fecha' => '2023-10-15', 'descripcion' => 'Falta de limpieza en áreas comunes.', 'estado' => 'En proceso']
];
?>

<div class="form-card" id="quejas-section">
    <h3 class="form-title">Registro de Quejas</h3>

    <div id="quejas-anteriores">
        <h4>Mis Quejas Anteriores:</h4>
        <br>
        <div id="lista-quejas">
            <?php foreach ($quejas as $queja): ?>
                <div>
                    <br>
                    <p><strong>Fecha:</strong> <?= $queja['fecha']; ?></p>
                    <br>
                    <p><strong>Descripción:</strong> <?= $queja['descripcion']; ?></p>
                    <br>
                    <p><strong>Estado:</strong> <?= $queja['estado']; ?></p>
                    <br>
                    <hr>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <br>

    <button id="nueva-queja-btn" class="btn btn-primary">Nueva queja</button>

    <form id="nueva-queja-form" style="display: none;" action="php/procesar_queja.php" method="POST">
        <div class="form-group">
            <label for="nueva-queja-descripcion">Descripción de la queja</label>
            <textarea class="form-control" id="nueva-queja-descripcion" name="descripcion" placeholder="Describe tu queja aquí"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Enviar Queja</button>
            <button type="button" id="cancelar-queja-btn" class="btn btn-secondary">Cancelar</button>
        </div>
    </form>
</div>