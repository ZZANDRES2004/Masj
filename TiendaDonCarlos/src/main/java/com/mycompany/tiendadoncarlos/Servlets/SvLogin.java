package com.mycompany.tiendadoncarlos.Servlets;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;
import javax.servlet.ServletContext;

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

        Usuario usu = control.traerUsuarioPorEmail(email);

        if (usu != null && password != null && password.equals(usu.getPassword())) {

            if (!usu.isActivo()) {
                response.sendRedirect("login.jsp?error=usuario_inactivo");
                return;
            }

            Rol rol = usu.getRol();
            if (rol != null) {
                String nombreRol = rol.getNombre().toLowerCase();

                HttpSession sesion = request.getSession();
                sesion.setAttribute("usuario", usu);
                sesion.setAttribute("rol", nombreRol);

                if (nombreRol.equals("admin")) {
                    sesion.setAttribute("listaUsuarios", control.traerUsuarios());
                    response.sendRedirect("admin.jsp");
                } else if (nombreRol.equals("empleado")) {
                    // Validar si empleado.jsp existe
                    String ruta = "/empleado.jsp";
                    ServletContext context = getServletContext();
                    if (context.getResource(ruta) != null) {
                        response.sendRedirect("empleado.jsp");
                    } else {
                        response.sendRedirect("error404.jsp");
                    }
                } else {
                    response.sendRedirect("login.jsp?error=acceso_denegado");
                }
                return;
            }
        }

        response.sendRedirect("login.jsp?error=credenciales_invalidas");
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.sendRedirect("login.jsp");
    }
}
