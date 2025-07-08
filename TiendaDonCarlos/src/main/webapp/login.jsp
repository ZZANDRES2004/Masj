
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%
    response.setHeader("Cache-Control", "no-cache, no-store, must-revalidate"); // HTTP 1.1
    response.setHeader("Pragma", "no-cache"); // HTTP 1.0
    response.setDateHeader("Expires", 0); // Proxies
%>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/login.css">

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
                    Inicia Sesion, y obten información sobre nuestros productos y promociones. <br> <br>
                    Ademas de poder saber tu histotria de compras y creditos pendientes
                    en caso de tenerlos en nuestra tienda 😁.
                </p>
                <div class="sgv">
                    <img class="carrito" src="svg/1.svg" alt="">
                </div>

                <h1 class="regresar"> 
                    <a class="atras" href="index.jsp#buttons"><img src="imagenes/arrow_back_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.png" alt="">Regresar</a>
                </h1>

                <footer class="pie">  <span class="tienda"> &copy; Tienda</span> DonCarlos</footer>
            </div>
        </section>

        <main>

            <div class="container">

                <h1 class="registro">Iniciar Sesion</h1>

                <form id="loginForm" action="SvLogin" method="POST" autocomplete="off" >

                    <br>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required autocomplete="off">
                    <br>
                    <label for="password">Contraseña:</label><br>
                    <input type="password" id="password" name="password" required autocomplete="new-password">
                    <br>
                    <button class="enviar" type="submit">Iniciar</button>

                </form>


                <%-- Mensajes de error --%>
                <%
                    String error = request.getParameter("error");
                    if ("usuario_inactivo".equals(error)) {
                %>
                <div class="mensaje-error">Tu cuenta está inhabilitada.</div>
                <%
                } else if ("credenciales_invalidas".equals(error)) {
                %>
                <div class="mensaje-error">Credenciales incorrectas. Intenta nuevamente.</div>
                <%
                } else if ("acceso_denegado".equals(error)) {
                %>
                <div class="mensaje-error">No tienes permisos para ingresar.</div>
                <%
                    }
                %>
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

