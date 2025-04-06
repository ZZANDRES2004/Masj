<!-- views/perfil.php --> 
<div class="form-card perfil-section">
    <h3 class="form-title">Mi Perfil</h3>

    <div class="perfil-contenedor">
        <!-- Columna izquierda -->
        <div class="perfil-info">
            <p><strong>Nombre:</strong> Andrés Rodríguez</p>
            <br>
            <p><strong>Torre:</strong> Torre 5</p>
            <br>
            <p><strong>Apartamento:</strong> Apto 501</p>
            <br>
            <p><strong>Vehículo:</strong> Nissan 2004</p>
            <br>
        </div>

        <!-- Columna derecha -->
        <div class="perfil-info">
            <p><trong>Email:</strong> andrez@gmail.com</p>
            <br>
            <p><strong>Teléfono:</strong> +57 300 123 4567</p>
            <br>
            <p><strong>Parqueadero Asignado:</strong> B-02</p>
            <br>
        </div>
    </div>

    <button class="btn btn-primary" id="editar-perfil-btn">Editar Perfil</button>

    <form id="form-editar-perfil" style="display:none; margin-top: 20px;">
        <input type="email" class="form-control" placeholder="Correo electrónico">
        <input type="number" class="form-control" placeholder="Teléfono">
        <button type="submit" class="btn btn-success">Guardar</button>
        <button type="button" class="btn btn-secondary" id="cancelar-edicion">Cancelar</button>
    </form>
</div>
