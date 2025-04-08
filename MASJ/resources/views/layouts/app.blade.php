<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MASJ</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <!-- Navbar superior -->
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #1e2a38;">
        <div class="container">
            <a class="navbar-brand logo text-warning fw-bold" href="{{ url('/') }}">
                MASJ
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side -->
                <ul class="navbar-nav me-auto"></ul>

                <!-- Right Side -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="me-2">{{ Auth::user()->name }}</span>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" alt="avatar" width="32" height="32" class="rounded-circle">
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('perfil') }}">
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Submenú horizontal -->
    <div class="submenu py-2" style="background-color: #1e2a38;">
        <div class="container d-flex gap-4 justify-content-center">
            <a href="{{ route('vehiculos.index') }}"
               class="submenu-link {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}">
               🚗 Registro de Vehículos
            </a>
            <a href="{{ route('paqueterias.index') }}"
               class="submenu-link {{ request()->routeIs('paqueterias.*') ? 'active' : '' }}">
               📦 Registro de Paquetería
            </a>
            <a href="{{ route('visitantes.index') }}"
               class="submenu-link {{ request()->routeIs('visitantes.*') ? 'active' : '' }}">
               🧍‍♂️ Control de Visitantes
            </a>
        </div>
    </div>

    <!-- Contenido principal -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>
