<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Registro</title>
    @vite(['resources/css/registro.css', 'resources/js/registro.js'])
</head>

<body>

    <div class="contenedor">
        <h1><span class="ci">Registrate</span></h1>
        {{-- Mostrar errores de validación generales --}}
        @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Asegúrate que la ruta 'registro' esté definida como POST en web.php --}}
        <form action="{{ route('registro') }}" method="POST" id="registroForm">
            @csrf
            <input type="text" name="PrimerNombre" id="name" required value="{{ old('PrimerNombre') }}" autocomplete="off" placeholder="Primer Nombre" minlength="3" maxlength="10"
            pattern="[A-Za-z\s]+" title="Solo letras y espacios">
            
            @error('PrimerNombre')
            <p class="error">{{ $message }}</p>
            @enderror

            <input type="text" name="SegundoNombre" placeholder="Segundo Nombre" value="{{ old('SegundoNombre') }}" autocomplete="off" minlength="3"
            maxlength="10">
            @error('SegundoNombre')
            <p class="error">{{ $message }}</p>
            @enderror

            <input type="text" name="PrimerApellido" placeholder="Primer Apellido" required value="{{ old('PrimerApellido') }}" autocomplete="off" placeholder="Primer Nombre" minlength="3" maxlength="10"
            pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" >
            @error('PrimerApellido')
            <p class="error">{{ $message }}</p>
            @enderror

            <input type="text" name="SegundoApellido" placeholder="Segundo Apellido" value="{{ old('SegundoApellido') }}" autocomplete="off" placeholder="Primer Nombre" minlength="3" maxlength="10"
            pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" >
            @error('SegundoApellido')
            <p class="error">{{ $message }}</p>
            @enderror

            | <div class="contenedor2">

                <label for="TipoDocumento" class="docu">Tipo de Documento:
                <select name="TipoDocumento" id="TipoDocumento" class="edicin-select" required>
                    <option value="">Selecciona</option>
                    <option value="cedula" {{ old('TipoDocumento') == 'cedula' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                    <option value="pasaporte" {{ old('TipoDocumento') == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                    <option value="cedula_extranjeria" {{ old('TipoDocumento') == 'cedula_extranjeria' ? 'selected' : '' }}>Cédula de Extranjería</option>
                </select>
                </label>
                @error('TipoDocumento')
                <p class="error">{{ $message }}</p>
                @enderror

                <label for="FechaNacimiento" class="fecha">Fecha de Nacimiento:
                <input type="date" name="FechaNacimiento" required value="{{ old('FechaNacimiento') }}" autocomplete="off">
                </label>
                @error('FechaNacimiento')
                <p class="error">{{ $message }}</p>
                @enderror

                @error('Estado')
                <p class="error">{{ $message }}</p>
                @enderror

                <label for="Rol" class="roles">Rol:
                <select name="Rol" class="edicin-select" required>
                    <option value="">Selecciona</option>
                    <option value="propietario" {{ old('Rol') == 'propietario' ? 'selected' : '' }}>Propietario</option>
                    <option value="arrendatario" {{ old('Rol') == 'arrendatario' ? 'selected' : '' }}>Arrendatario</option>
                </select>
                </label>
                @error('Rol')
                <p class="error">{{ $message }}</p>
                @enderror

            </div>
            <input type="text" name="NumDocumento" placeholder="Número de Documento" required value="{{ old('NumDocumento') }}"
            autocomplete="off" minlength="6" maxlength="10" pattern="[0-9]+" title="Solo se permiten números" />
            @error('NumDocumento')
            <p class="error">{{ $message }}</p>
            @enderror

            <input type="text" name="NumeroCelular" placeholder="Número de Celular" required value="{{ old('NumeroCelular') }}"
            autocomplete="off" minlength="10" maxlength="10" pattern="[0-9]+" title="Solo se permiten números" />
            @error('NumeroCelular')
            <p class="error">{{ $message }}</p>
            @enderror

            <input type="email" name="CorreoElectronico" placeholder="Correo Electrónico" required value="{{ old('CorreoElectronico') }}" autocomplete="off">
            @error('CorreoElectronico')
            <p class="error">{{ $message }}</p>
            @enderror

            <input type="text" name="ConjuntoNombre" placeholder="Nombre del Conjunto" required value="{{ old('ConjuntoNombre') }}" autocomplete="off">
            @error('ConjuntoNombre')
            <p class="error">{{ $message }}</p>
            @enderror

            <input type="password" id="Contraseña" name="Contraseña" required placeholder="Contraseña" /><br />

            <input type="password" id="confirmPassword" name="confirmate" required placeholder="Confirmar contraseña"
                /><br />
            @error('Contraseña')
            <p class="error">{{ $message }}</p>
            @enderror
            <div id="passwordStrength" class="password-strength"></div>
            <ul class="password-requirements">
                <li id="length" class="invalid">
                    <img src="{{ asset('imagenes/error_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg') }}" alt="Alerta" class="alert"><span class="cara">Al menos 8 caracteres</span>
                </li>
                <li id="uppercase" class="invalid">
                    <img src="{{ asset('imagenes/error_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg') }}" alt="Alerta" class="alert">Una letra mayúscula
                </li>
                <li id="lowercase" class="invalid">
                    <img src="{{ asset('imagenes/error_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg') }}" alt="Alerta" class="alert"><span class="min">Una letra minúscula</span>
                </li>
                <li id="number" class="invalid">
                    <img src="{{ asset('imagenes/error_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg') }}" alt="Alerta" class="alert">Un número
                </li>
                <li id="special" class="invalid">
                    <img src="{{ asset('imagenes/error_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg') }}" alt="Alerta" class="alert">Un carácter especial
                </li>
            </ul>

            <div id="passwordMatch" class="password-match"></div>

            <button type="submit" class="enviar">Registrarse</button>
                  
        </form>

        {{-- Mantenido por si hay errores de sesión flash (aunque los de validación son más comunes aquí) --}}
        @if (session('error'))
        <p class="error">{{ session('error') }}</p>
        @endif

        <div class="login">
            <h2 class="cuenta">¿Ya tienes una cuenta?</h2>
            {{-- Asegúrate que la ruta 'Login' exista y sea GET (o usa un nombre como 'login.form') --}}
            <a href="{{ route('Login.form') }}" class="inicia">Inicia sesión aquí</a>
        </div>
    </div>



</body>


</html>