<?php
// Incluir archivos de configuración
// include('config.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Residencial</title>
    <link rel="stylesheet" href="../css/residente.css">
</head>
<body>
     <!-- ENCABEZADO -->
     <header>
    <div class="container header-content">
    <div class="logo">MASJ</div>
    <div class="user-menu">
    <div class="user-info" id="user-dropdown-toggle">
        <img src="usuario.png" class="user-avatar" alt="Avatar">
        <span>Andrés Rodríguez | Apto 501</span>
        <span class="dropdown-icon">▼</span>
    </div>
    <div class="dropdown-menu" id="user-dropdown-menu">
        <ul>
        <li><a href="#" data-section="perfil"><span class="user-icon">👤</span> Mi Perfil</a></li>
            <li><a href="#"><span class="user-icon">📃</span> Cerrar Sesión</a></li>
        </ul>
    </div>
</div>
            </div>
        </div>
    </header>
     <!-- NAVEGACIÓN PRINCIPAL -->

    <nav>
        <div class="container">
            <div class="nav-content">
                <ul class="nav-links">
                    <li><a href="#" class="nav-link active" data-section="dashboard">Inicio</a></li>
                    <li><a href="#" class="nav-link" data-section="quejas">Quejas</a></li>
                    <li><a href="#" class="nav-link" data-section="zonas-comunes">Zonas Comunes</a></li>
                    <li><a href="#" class="nav-link" data-section="visitantes">Visitantes</a></li>
                    <li><a href="#" class="nav-link" data-section="correspondencia">Correspondencia</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="main-content" style="justify-content: center;">
            <div class="content-panel" id="content-panel">
                <div id="dashboard-content">
                    <h2>Andres Martinez|Apto 301</h2>
                    <br>
                    <p>Bienvenido al sistema de gestión residencial MASJ.</p>
                    <br>

                    <div class="dashboard-stats">
                        <div class="stat-card">
                            <h3>Quejas</h3>
                            <div class="stat-value">2</div>
                        </div>
                        <div class="stat-card">
                            <h3>Reservas</h3>
                            <div class="stat-value">1</div>
                        </div>
                        <div class="stat-card">
                            <h3>Visitantes</h3>
                            <div class="stat-value">3</div>
                        </div>
                        <div class="stat-card">
                            <h3>Correspondencia</h3>
                            <div class="stat-value">5</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/perfil.js"></script>
    <script src="../js/residente.js"></script>
    <script src="../js/quejas.js"></script>
    <script src="../js/zonas.js"></script>
    <script src="../js/visitantes.js"></script>
    <script src="../js/correspondencia.js"></script>
</body>
</html>
