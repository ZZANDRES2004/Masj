<?php
// Datos simulados de reservas anteriores
$reservas = [
    ['fecha' => '2024-03-15', 'zona' => 'Piscina', 'estado' => 'Aprobado'],
    ['fecha' => '2024-03-10', 'zona' => 'Salón Comunal', 'estado' => 'Pendiente']
];
?>

<div class="form-card" id="reservas-section">
    <h3 class="form-title">Reserva de Zonas Comunes</h3>

    <div id="reservas-anteriores">
        <h4>Mis Reservas:</h4>
      
        <div id="lista-reservas">
            <?php foreach ($reservas as $reserva): ?>
                <div>
                    <br>
                    <p><strong>Fecha:</strong> <?= $reserva['fecha']; ?></p>
                    <br>
                    <p><strong>Zona:</strong> <?= $reserva['zona']; ?></p>
                    <br>
                    <p><strong>Estado:</strong> <?= $reserva['estado']; ?></p>
                    <hr>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <br>

    <button id="nueva-reserva-btn" class="btn btn-primary">Nueva reserva</button>

    <form id="reservas-form" style="display: none;" action="php/procesar_reserva.php" method="POST">
        <div class="form-group">
            <label for="reserva-zona">Zona Común</label>
            <select class="form-control" id="reserva-zona" name="zona" required>
                <option value="">Seleccione zona</option>
                <option value="Salón Comunal">Salón Comunal</option>
                <option value="Piscina">Piscina</option>
                <option value="Gimnasio">Gimnasio</option>
                <option value="BBQ">BBQ</option>
                <option value="Parque Infantil">Parque Infantil</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha-reserva">Fecha</label>
            <input type="date" class="form-control" id="fecha-reserva" name="fecha" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Solicitar Reserva</button>
            <button type="button" id="cancelar-reserva-btn" class="btn btn-secondary">Cancelar</button>
        </div>
    </form>
</div>

