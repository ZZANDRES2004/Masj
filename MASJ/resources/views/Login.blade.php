<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    @vite(['resources/css/Login.css', 'resources/js/Login.js'])
</head>
<body>
    <div>
        <div class="formulario">
            <h1>Iniciar Sesión</h1>
            <form action="{{ route('Login.attempt') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Correo" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
            @if (session('error'))
                <p class="error">{{ session('error') }}</p>
            @endif
        </div>
        <div class="registro">
            <h2>¿No tienes una cuenta?</h2>
            <a href="{{ route('registro.form') }}">Regístrate aquí</a>
        </div>
    </div>
</body>
</html>