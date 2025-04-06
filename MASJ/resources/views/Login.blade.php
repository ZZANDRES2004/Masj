<!-- Archivo: resources/views/Login.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    @vite(['resources/css/Login.css'])
</head>

<body>
    <div class="contenedor">
        <div class="formulario">
            <h1 class="ci">Iniciar Sesión</h1>
            
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            <form action="{{ route('Login.attempt') }}" method="POST">
                @csrf
                <input type="email" name="email" id="CorreoElectronico" placeholder="Correo" required>
                <input type="password" name="password" id="Contraseña" placeholder="Contraseña" required>

                <a class="contraseña" href="{{ route('password.request') }}">Olvidé mi contraseña</a>

                <button type="submit" class="enviar">Iniciar Sesión</button>
                
            </form>
            @if (session('error'))
            <p class="error">{{ session('error') }}</p>
            @endif

        </div>
        <div class="registro">
            <h2 class="cuenta">¿No tienes una cuenta?</h2>
            <a href="{{ route('registro.form') }}" class="inicia">Regístrate aquí</a>
        </div>
    </div>
</body>

</html>