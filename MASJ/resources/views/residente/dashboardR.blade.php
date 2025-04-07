<?php
// Archivo: resources/views/dashboard.blade.php

// Asumiendo que estos datos vienen del controlador
// $quejas, $reservas, $visitantes, $correspondencia
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Residencial</title>
    <link rel="stylesheet" href="{{ asset('../resources/css/residente/residente.css') }}">
    <script src="{{ asset('js/residente/quejas.js') }}"></script>
</head>

<body>
    <!-- ENCABEZADO -->
    <header>
        <div class="container header-content">
            <div class="logo">MASJ</div>
            <div class="user-menu">
                <div class="user-info" id="user-dropdown-toggle">
                    <img src="{{ asset('imagenes/usuario.png') }}" class="user-avatar" alt="Avatar">
                    <span class="user-name">{{ Auth::user()->PrimerNombre }} {{ Auth::user()->PrimerApellido }}</span>
                    <span class="user-role">Residente</span>
                    <span class="dropdown-icon">▼</span>
                </div>
                <div class="dropdown-menu" id="user-dropdown-menu">
                    <ul>
                        <li><a href="#" data-section="perfil"><span class="user-icon">👤</span> Mi Perfil</a></li>
                        <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="user-icon">📃</span> Cerrar Sesión</a></li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
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
                    <li><a href="{{ route('dashboard') }}" class="nav-link active" data-section="dashboard">Inicio</a></li>
                    <li><a href="{{ route('quejas.index') }}" class="nav-link" data-section="quejas">Quejas</a></li>
                    <li><a href="{{ route('zonas-comunes') }}" class="nav-link" data-section="zonas-comunes">Zonas Comunes</a></li>
                    <li><a href="{{ route('visitantes.index') }}" class="nav-link" data-section="visitantes">Visitantes</a></li>
                    <li><a href="{{ route('correspondencia') }}" class="nav-link" data-section="correspondencia">Correspondencia</a></li>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="main-content" style="justify-content: center;">
            <div class="content-panel" id="content-panel">
                <div id="dashboard-content">
                    <br>
                    <p>Bienvenido al sistema de gestión residencial MASJ.</p>
                    <br>

                    <div class="dashboard-stats">
                        <div class="stat-card">
                            <h3>Quejas</h3>
                            <div class="stat-value">{{ $quejas ?? 0 }}</div>
                        </div>
                        <div class="stat-card">
                            <h3>Reservas</h3>
                            <div class="stat-value">{{ $reservas ?? 0 }}</div>
                        </div>
                        <div class="stat-card">
                            <h3>Visitantes</h3>
                            <div class="stat-value">{{ $visitantes ?? 0}}</div>
                        </div>
                        <div class="stat-card">
                            <h3>Correspondencia</h3>
                            <div class="stat-value">{{ $correspondencia ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('../resources/js/residente/perfil.js') }}"></script>
    <script src="{{ asset('../resources/js/residente/residente.js') }}"></script>
    <script src="{{ asset('../resources/js/residente/quejas.js') }}"></script>
    <script src="{{ asset('../resources/js/residente/zonas.js') }}"></script>
    <script src="{{ asset('../resources/js/residente/visitantes.js') }}"></script>
    <script src="{{ asset('../resources/js/residente/correspondencia.js') }}"></script>

</body>

</html>