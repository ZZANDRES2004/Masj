<!DOCTYPE html>
<html>
<head>
    <title>Restablecimiento de Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2d6eb9;
            padding: 15px;
            color: white;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .button {
            display: inline-block;
            background-color: #2d6eb9;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Restablecimiento de Contraseña</h2>
    </div>
    
    <div class="content">
        <p>Hola,</p>
        
        <p>Has recibido este correo porque solicitaste un restablecimiento de contraseña para tu cuenta.</p>
        
        <p>
            <a href="{{ url('reset-password/'.$token.'?email='.urlencode($email)) }}" class="button">
                Restablecer Contraseña
            </a>
        </p>
        
        <p>Este enlace de restablecimiento de contraseña expirará en 24 horas.</p>
        
        <p>Si no solicitaste un restablecimiento de contraseña, no es necesario realizar ninguna acción.</p>
        
        <p>Saludos,<br>Tu Aplicación</p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} Tu Aplicación. Todos los derechos reservados.</p>
    </div>
</body>
</html>