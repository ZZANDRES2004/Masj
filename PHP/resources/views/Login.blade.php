<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
    <style>
        .formulario, .registro {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .error {
            color: red;
        }
    </style>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Pariatur quis ullam perspiciatis libero eius molestiae, soluta, laborum cupiditate nulla animi, obcaecati magnam voluptas ipsa provident tenetur quasi aperiam dolore quod!</p>
</body>
</html>