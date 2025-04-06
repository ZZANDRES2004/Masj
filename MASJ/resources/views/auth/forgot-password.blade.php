<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/Login.css'])
    <style>
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    <div class="contenedor3">
        <div class="formulario">
            <h1 class="ci">Recuperar Contraseña</h1>
            
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <input type="email" name="CorreoElectronico" id="CorreoElectronico" placeholder="Correo Electrónico" required>
                
                @error('CorreoElectronico')
                    <p class="error">{{ $message }}</p>
                @enderror
                
                <button type="submit" class="enviar">Enviar enlace de recuperación</button>
            </form>
            
            <div class="volver-login">
                <a href="{{ route('Login.form') }}" class="contraseña">Volver al inicio de sesión</a>
            </div>
        </div>
    </div>
</body>
</html>