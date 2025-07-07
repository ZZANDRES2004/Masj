package com.mycompany.tiendadoncarlos.Servlets;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

import logica.Controladora;
import logica.Usuario;
import logica.Rol;

@WebServlet(name = "SvLogin", urlPatterns = {"/SvLogin"})
public class SvLogin extends HttpServlet {
    
Controladora control = new Controladora();

@Override
protected void doPost(HttpServletRequest request, HttpServletResponse response)
        throws ServletException, IOException {

    String email = request.getParameter("email");
    String password = request.getParameter("password");

    Usuario usu = control.traerUsuarioPorEmail(email); // Asegúrate de tener implementado este método

    if (usu != null && usu.getPassword().equals(password)) {
        Rol rol = usu.getRol();

        if (rol != null) {
            String nombreRol = rol.getNombre().toLowerCase();

            HttpSession sesion = request.getSession();
            sesion.setAttribute("usuario", usu);
            sesion.setAttribute("rol", nombreRol);

            if (nombreRol.equals("admin")) {
                // Cargar lista de usuarios si es admin
                sesion.setAttribute("listaUsuarios", control.traerUsuarios());
                response.sendRedirect("admin.jsp");
            } else if (nombreRol.equals("empleado")) {
                response.sendRedirect("empleado.jsp");
            } else {
                // Cliente u otro rol no permitido
                response.sendRedirect("login.jsp?error=acceso_denegado");
            }
            return;
        }
    }

    // Credenciales inválidas
    response.sendRedirect("login.jsp?error=credenciales_invalidas");
}

@Override
protected void doGet(HttpServletRequest request, HttpServletResponse response)
        throws ServletException, IOException {
    response.sendRedirect("login.jsp");
}
}