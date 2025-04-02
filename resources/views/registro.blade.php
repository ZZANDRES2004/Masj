<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    @vite(['resources/css/registro.css', 'resources/js/registro.js'])
</head>
<body>
    <div>
        <div class="formulario">
            <h1>Registro</h1>
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
            <form action="{{ route('registro') }}" method="POST">
                @csrf
                <input type="text" name="PrimerNombre" placeholder="Primer Nombre" required value="{{ old('PrimerNombre') }}">
                @error('PrimerNombre')
                <p class="error">{{ $message }}</p>
                @enderror

                <input type="text" name="SegundoNombre" placeholder="Segundo Nombre (Opcional)" value="{{ old('SegundoNombre') }}">
                @error('SegundoNombre')
                <p class="error">{{ $message }}</p>
                @enderror

                <input type="text" name="PrimerApellido" placeholder="Primer Apellido" required value="{{ old('PrimerApellido') }}">
                @error('PrimerApellido')
                <p class="error">{{ $message }}</p>
                @enderror

                <input type="text" name="SegundoApellido" placeholder="Segundo Apellido (Opcional)" value="{{ old('SegundoApellido') }}">
                @error('SegundoApellido')
                <p class="error">{{ $message }}</p>
                @enderror

                <input type="text" name="NumeroCelular" placeholder="Número de Celular" required value="{{ old('NumeroCelular') }}">
                @error('NumeroCelular')
                <p class="error">{{ $message }}</p>
                @enderror

                <input type="email" name="CorreoElectronico" placeholder="Correo Electrónico" required value="{{ old('CorreoElectronico') }}">
                @error('CorreoElectronico')
                <p class="error">{{ $message }}</p>
                @enderror

                <input type="password" name="Contrasena" placeholder="Contraseña" required>
                @error('Contrasena')
                <p class="error">{{ $message }}</p>
                @enderror

                <input type="text" name="ConjuntoNombre" placeholder="Conjunto Nombre" required value="{{ old('ConjuntoNombre') }}">
                @error('ConjuntoNombre')
                <p class="error">{{ $message }}</p>
                @enderror

                <label for="FechaNacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="FechaNacimiento" required value="{{ old('FechaNacimiento') }}">
                @error('FechaNacimiento')
                <p class="error">{{ $message }}</p>
                @enderror

                <label for="Estado">Estado:</label>
                <select name="Estado" required>
                    <option value="activo" {{ old('Estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('Estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('Estado')
                <p class="error">{{ $message }}</p>
                @enderror

                <label for="Rol">Rol:</label>
                <select name="Rol" required>
                    <option value="propietario" {{ old('Rol') == 'propietario' ? 'selected' : '' }}>Propietario</option>
                    <option value="arrendatario" {{ old('Rol') == 'arrendatario' ? 'selected' : '' }}>Arrendatario</option>
                    <option value="guardia" {{ old('Rol') == 'guardia' ? 'selected' : '' }}>Guardia</option>
                    <option value="administrador" {{ old('Rol') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                </select>
                @error('Rol')
                <p class="error">{{ $message }}</p>
                @enderror

                <input type="text" name="TipoDocumento" placeholder="Tipo de Documento" required value="{{ old('TipoDocumento') }}">
                @error('TipoDocumento')
                <p class="error">{{ $message }}</p>
                @enderror

                <input type="number" name="NumDocumento" placeholder="Número de Documento" required value="{{ old('NumDocumento') }}">
                @error('NumDocumento')
                <p class="error">{{ $message }}</p>
                @enderror

                <button type="submit">Registrarse</button>
            </form>

            {{-- Mantenido por si hay errores de sesión flash (aunque los de validación son más comunes aquí) --}}
            @if (session('error'))
            <p class="error">{{ session('error') }}</p>
            @endif
        </div>
        <div class="login">
            <h2>¿Ya tienes una cuenta?</h2>
            {{-- Asegúrate que la ruta 'Login' exista y sea GET (o usa un nombre como 'login.form') --}}
            <a href="{{ route('Login.form') }}">Inicia sesión aquí</a>
        </div>
    </div>
</body>

</html>