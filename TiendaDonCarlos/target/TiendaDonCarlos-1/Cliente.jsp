<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
   
</head>

<body>
    <section class="izquierda">
        <h1 class="logo">
            <span class="tienda">Tienda</span><br>
            <span class="carlos">Don Carlos</span>
            <link rel="stylesheet" href="css/Cliente.css">

        </h1>

        <ul class="nave" style="list-style: none;">
            <li><a href="admin.jsp">Dashboard</a></li>
            <li><a href="SvUsuario">Usuarios</a></li>
            <li><a href="clientes.jsp" class="active-link">Clientes</a></li>
            <li><a href="#">Reportes</a></li>
            <li><a href="#">Alertas</a></li>
            <li><a href="#">Ajustes</a></li>
        </ul>
    </section>

    <header class="info">
        <section class="usuario">
            <h2>Panel de Registro de Clientes</h2>
            <button>
                <img class="ir" src="imagenes/hogar.png" alt="ir" width="30px" height="30px">
                <span class="direccion">
                    <a href="login.jsp">Cerrar Sesión</a>
                </span>
            </button>
        </section>
    </header>

    <main>
        <div class="container2">
            <form action="SvRegistrarCliente" method="POST" class="formulario-cliente">
                <h3 style="margin-bottom: 15px;">Registro de Cliente</h3>

                <input type="text" name="nombre" placeholder="Nombre completo" required>
                <input type="text" name="direccion" placeholder="Dirección" required>
                <input type="text" name="telefono" placeholder="Teléfono" required>
                <input type="email" name="email" placeholder="Correo electrónico" required>
                <input type="text" name="documento" placeholder="Documento de identidad" required>
                <input type="text" name="categoria" placeholder="Categoría crediticia" required>
                <input type="number" step="0.01" name="limite" placeholder="Límite de crédito" required>

                <input type="submit" value="Registrar Cliente" class="enviar">
            </form>
        </div>

        <div class="planta1">
            <img src="svg/plantas/planta1.webp" width="500px" height="500px" alt="">
        </div>
        <div class="planta2">
            <img src="svg/plantas/planta2.webp" width="500px" height="500px" alt="">
        </div>
        <div class="planta3">
            <img src="svg/plantas/planta6.webp" width="500px" height="500px" alt="">
        </div>
        <div class="frutas">
            <img src="svg/plantas/Untitled-design.webp" width="1200px" height="700px" alt="">
        </div>
    </main>
</body>
</html>
