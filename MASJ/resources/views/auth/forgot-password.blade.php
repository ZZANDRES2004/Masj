
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

<div class="container">
    <div class="background"></div>
    
    <div class="circles">
      <div class="circle"></div>
      <div class="circle"></div>
      <div class="circle"></div>
    </div>
    
    <div class="lines"></div>
    <div class="neon-ring"></div>
    <div class="glow"></div>
    
    <div class="MASJ">
      <div class="letter M">M</div>
      <div class="letter A">A</div>
      <div class="letter S">S</div>
      <div class="letter J">J</div>
    </div>
  </div>

    <div class="contenedor3">
        <div class="formulario">
            <h1 class="ci">Recuperar Contraseña</h1>
            
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <input type="email" name="CorreoElectronico" placeholder="Correo Electrónico" required>
                <button type="submit" class="enviar">Enviar enlace</button>
            </form>
            
            <div class="volver-login">
                <a href="{{ route('Login.form') }}" class="contraseña">Volver al inicio de sesión</a>
            </div>
        </div>
    </div>
</body>