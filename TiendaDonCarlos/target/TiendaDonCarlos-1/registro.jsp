
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" 
rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Playwrite+DK+Loopet:wght@100..400&display=swap" rel="stylesheet">

    <title>Registro</title>
</head>
<body>
    <section class="contenedor">

        <div class="desliza">
    <h1 class="titulo">Tienda de DonCarlos</h1>

    <p class="contenido">
        Registro de Clientes 😁.
    </p>
    <div class="sgv">
        <img class="carrito" src="svg/1.svg" alt="">
        
        
    </div>

    <h1 class="regresar"> 
        <a href="adminUsuarios.jsp#buttons"><img src="imagenes/arrow_back_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.png" alt="">Regresar</a>
    </h1>

    <footer class="pie">  <span class="tienda"> &copy; Tienda</span> DonCarlos</footer>
    </div>
</section>

    <main>
       
        <div class="container">

             <h1 class="registro">Registro</h1>

            <form action="SvUsuario" method="POST">

                <br>
                <label for="name">Nombre Completo:</label><br>
                <input type="text" id="name" name="name" required>

                <br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required>
<br>
                <label for="password">Contraseña:</label><br>
                <input type="password" id="password" name="password" required>
<br>
                <button class="enviar" type="submit">Registrarse</button>
           
        </div>

        <div class="container2">
            <label for="direccion">Dirección</label><br>
            <input type="text" id="direccion" name="direccion" required>
            <br>

            <label for="telefono">Teléfono</label>
            <input type="number" id="telefono" name="telefono" required>
            <br>

            <label for="documento">No. Tipo Documento</label>
            <select name="tipo_documento" id="tipo_documento">
                <option value="">Seleccione</option>
                <option value="cedula">Cedula de ciudadnia</option>
            </select>
            <input type="text" id="documento" name="documento" required>
            <br>
            <label for="fecha">Fecha de registro</label>
            <input type="date" id="fecha" name="fecha" required>
            
             </form>
        </div>

        <div id="planta1">
            <img class="planta1" src="svg/plantas/planta1.webp" width="500px" height="500px" alt="">
        </div>

        <div class="planta2">
            <img class="planta2" src="svg/plantas/planta2.webp" width="500px" height="500px" alt="">
        </div>

        <div class="planta3">
            <img class="planta3" src="svg/plantas/planta6.webp" width="500px" height="500px" alt="">
        </div>

        <div class="frutas">
            <img src="svg/plantas/Untitled-design.webp" width="1200px" height="700px" alt="">
        </div>
    </main>
    
</body>
</html>