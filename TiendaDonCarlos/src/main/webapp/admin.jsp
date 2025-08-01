<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%
    HttpSession sesion = request.getSession(false);
    if (sesion == null || sesion.getAttribute("usuario") == null) {
        response.sendRedirect("login.jsp");
        return;
    }
%>

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

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link

            href="https:
            /fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Playwrite+DK+Loopet:wght@100..400&display=swap"
            rel="stylesheet">

        <link rel="stylesheet" href="css/admin.css">

        <title>Admin Dashboard</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    </head>

    <body>

        <section class="izquierda">

            <h1 class="logo"><span class="tienda">Tienda</span><br><span class="carlos">Don Carlos</span> </h1>

            <ul class="nave" style="list-style: none;">
                <li class="dash active-link" data-target="dashboard-content"> <span class="icono"><svg
                            xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#1f1f1f">
                        <path
                            d="M600-160v-280h280v280H600ZM440-520v-280h440v280H440ZM80-160v-280h440v280H80Zm0-360v-280h280v280H80Zm440-80h280v-120H520v120ZM160-240h280v-120H160v120Zm520 0h120v-120H680v120ZM160-600h120v-120H160v120Zm360 0Zm-80 240Zm240 0ZM280-600Z" />
                        </svg></span>Dashboard</li>

                <li class="alerts" data-target="alertas-content">
                    <span class="icono">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                             fill="#1f1f1f">
                        <path
                            d="M160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160Zm320-300Zm0 420q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80ZM320-280h320v-280q0-66-47-113t-113-47q-66 0-113 47t-47 113v280Z" />
                        </svg>
                    </span>
                    Alertas
                </li>

                <li class="reports" data-target="reportes-content">
                    <span class="icono">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#1f1f1f">
                        <path
                            d="M320-480v-80h320v80H320Zm0-160v-80h320v80H320Zm-80 240h300q29 0 54 12.5t42 35.5l84 110v-558H240v400Zm0 240h442L573-303q-6-8-14.5-12.5T540-320H240v160Zm480 80H240q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h480q33 0 56.5 23.5T800-800v640q0 33-23.5 56.5T720-80Zm-480-80v-640 640Zm0-160v-80 80Z" />
                        </svg>
                    </span>Reportes</li>

                <li class="users" data-target="usuarios-content">
                    <a href="SvUsuario">
                        <span class="icono">
                            <svg
                                xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#1f1f1f">
                            <path
                                d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780Zm-455-80h311q-10-20-55.5-35T480-370q-55 0-100.5 15T325-320ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-80q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560Zm1 240Zm-1-280Z" />
                            </svg>
                        </span> Usuarios
                    </a>    
                </li>

                <li class="users">
                    <a href="Cliente.jsp" style="display: flex; align-items: center; gap: 8px; text-decoration: none;">
                         <svg
                                xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#1f1f1f">
                            <path
                                d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780Zm-455-80h311q-10-20-55.5-35T480-370q-55 0-100.5 15T325-320ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-80q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560Zm1 240Zm-1-280Z" />
                            </svg>
                        <span>Clientes</span>
                    </a>
                </li>
                <li class="reports">
                    <a href="registrarCredito.jsp" style="display: flex; align-items: center; gap: 8px; text-decoration: none;">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#1f1f1f">
                        <path
                            d="M320-480v-80h320v80H320Zm0-160v-80h320v80H320Zm-80 240h300q29 0 54 12.5t42 35.5l84 110v-558H240v400Zm0 240h442L573-303q-6-8-14.5-12.5T540-320H240v160Zm480 80H240q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h480q33 0 56.5 23.5T800-800v640q0 33-23.5 56.5T720-80Zm-480-80v-640 640Zm0-160v-80 80Z" />
                        </svg>
                        <span>Creditos</span>
                    </a>
                </li>



                <li class="settings" data-target="ajustes-content"><span class="icono"><svg
                            xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#1f1f1f">
                        <path
                            d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z" />
                        </svg>
                    </span>Ajustes</li>
            </ul>
        </section>

        <header class="info">
            <section class="usuario">
                <h2>Bienvenido, [Nombre del Usuario]</h2>
                <button>
                    <img class="ir" src="imagenes/hogar.png" alt="ir" width="30px" height="30px">
                    <span class="direccion">
                        <a href="SvLogout"> Cerrar Sesion</a> </span>
                </button>
            </section>
        </header>

        <main id="reportes-content" class="contenido content-section">

            <div class="dashboard">
                <h3>Panel de Reportes</h3>

                <p class="info2">⚠ Resumen de Actividades Recientes</p>

                <div class="cards">
                    <div class="card">
                        <h4>Total de Ventas</h4>
                        <p>$10,000</p>
                    </div>
                    <div class="card">
                        <h4>Nuevos Usuarios</h4>
                        <p>150</p>
                    </div>
                    <div class="card">
                        <h4>Alertas Pendientes</h4>
                        <p>5</p>
                    </div>
                    <div class="card">
                        <h4>Reportes Generados</h4>
                        <p>20</p>
                    </div>

                    <button class="revisar">
                        <img class="ir" src="imagenes/angulo-pequeno-derecho.png" alt="ir" width="16px">
                        <span class="direccion">
                            <a href="#"> Ir</a> </span>
                    </button>
                </div>
        </main>


        <main id="alertas-content" class="contenido2 content-section hidden">

            <div  class="dashboard">
                <h3>Panel de Alertas</h3>

                <p class="info2">⚠ Resumen de Alertas Recientes</p>

                <ul style="list-style: none;">
                    <li class="alerta1">
                        <img src="imagenes/campana.png" alt="alerta">
                        Cliente [Nombre del usuario], registrado exitosamente el...
                    </li>
                    <hr>
                    <li class="alerta2">
                        <img src="imagenes/campana.png" alt="alerta">
                        registro de compra realizada por $240.000, el cliente realiza el pago por datafono.
                    </li>
                </ul>


                <button class="revisar">
                    <img class="ir" src="imagenes/angulo-pequeno-derecho.png" alt="ir" width="16px">
                    <span class="direccion">
                        <a href="#"> Ir</a> </span>
                </button>
            </div>
        </main>


        <main id="reportes-content" class="contenido3 content-section hidden">
            <div class="chart-header">
                <h3 class="chart-title">📈 Ganancias en Tiempo Real</h3>
                <div class="chart-controls">
                    <button class="chart-btn" onclick="changeChartView('week')">Semana</button>
                    <button class="chart-btn" onclick="changeChartView('month')">Mes</button>
                    <button class="chart-btn" onclick="changeChartView('year')">Año</button>
                </div>
            </div>

            <div class="chart-container">
                <canvas id="profitChart"></canvas>
            </div>

            <div class="stats-mini">
                <div class="stat-mini">
                    <div class="stat-mini-value" id="totalProfit">$45,000</div>
                    <div class="stat-mini-label">Total</div>
                </div>
                <div class="stat-mini">
                    <div class="stat-mini-value" id="avgProfit">$7,500</div>
                    <div class="stat-mini-label">Promedio</div>
                </div>
                <div class="stat-mini">
                    <div class="stat-mini-value" id="growth">+12.5%</div>
                    <div class="stat-mini-label">Crecimiento</div>
                </div>
            </div>
        </main>


        <main id="usuarios-content" class="contenido4 content-section hidden">

            <div class="dashboard">
                <h3>Panel de Usuarios</h3>

                <p class="info2">⚠ Resumen de Usuarios Activos</p>

                <ul style="list-style: none;">
                    <c:forEach var="u" items="${listaUsuarios}">
                        <li class="usuarios">
                            <div class="usu">
                                <img src="imagenes/usuario (1).png" alt="">
                                <div>${u.name} (${u.rol.nombre})</div>
                            </div>
                        </li>
                        <hr>
                    </c:forEach>
                </ul>




                <button class="revisar">
                    <img class="ir" src="imagenes/angulo-pequeno-derecho.png" alt="ir" width="16px">
                    <span class="direccion">
                        <a href="#"> Ir</a> </span>
                </button>
            </div>
        </main>


        <main>
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

            <div class="arbol">
                <img src="svg/plantas/planta4.webp" wid th="1200px" height="700px" alt="">
            </div>
        </main>
    </body>
    <script src="javaScript/admin.js"></script>

</html>


