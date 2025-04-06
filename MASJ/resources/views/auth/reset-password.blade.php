<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    @vite(['resources/css/Login.css'])
</head>

<body>
    <div class="contenedor3">
        <div class="formulario">
            <h1 class="ci">Restablecer Contraseña</h1>
            
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <input type="email" name="email" id="CorreoElectronico" placeholder="Correo Electrónico" required>
                
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
                
                <input type="password" name="Contraseña" id="Contraseña" placeholder="Nueva Contraseña" required>
                
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
                
                <input type="password" name="password_confirmation" id="ConfirmarContrasena" placeholder="Confirmar Contraseña" required>

                <button type="submit" class="enviar">Restablecer Contraseña</button>
            </form>
        </div>
    </div>
</body>

</html>