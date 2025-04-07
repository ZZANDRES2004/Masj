<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts y Estilos -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <!-- LOGO / MARCA -->
                <a class="navbar-brand logo" href="{{ url('/') }}">
                    MASJ
                </a>

                <!-- Botón de colapsar -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido de la barra de navegación -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Lado Izquierdo -->
                    <ul class="navbar-nav me-auto">
                        <!-- Aquí puedes agregar enlaces si lo necesitas -->
                    </ul>

                    <!-- Lado Derecho / Menú -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdownMenu" class="nav-link dropdown-toggle text-white fs-5" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menú
                            </a>
                        <div class="dropdown-menu dropdown-menu-end bg-dark text-white p-3 rounded shadow" style="min-width: 200px;" aria-labelledby="navbarDropdownMenu">
                            <a class="dropdown-item text-dark fs-5" href="{{ route('vehiculos.index') }}">🧍‍♂️ mi perfil</a>
                            <a class="dropdown-item text-dark fs-5" href="#">Cerrar Seccion</a>   
                        </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

<!-- Submenú horizontal -->
<div class="submenu bg-dark-purple text-white py-2">
    <div class="container d-flex gap-4 justify-content-center">
        <a href="{{ route('vehiculos.index') }}" class="submenu-link text-white text-decoration-none fs-5">🚗 Registro de Vehículos</a>
        <a href="{{ route('paqueterias.index') }}" class="submenu-link">📦 Registro de Paquetería</a>

        <a href="{{route('visitantes.index') }}" class="submenu-link text-white text-decoration-none fs-5">🧍‍♂️ Control de Visitantes</a>
    </div>
</div>


<!-- Contenido Principal -->
<main class="py-4">

        <!-- Contenido Principal -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
