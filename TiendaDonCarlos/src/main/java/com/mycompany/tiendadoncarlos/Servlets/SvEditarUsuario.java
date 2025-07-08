package com.mycompany.tiendadoncarlos.Servlets;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;
import logica.Controladora;
import logica.Rol;
import logica.Usuario;

@WebServlet(name = "SvUsuarioEditar", urlPatterns = {"/SvUsuarioEditar"})
public class SvEditarUsuario extends HttpServlet {

Controladora control = new Controladora();

@Override
protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {

    int id = Integer.parseInt(request.getParameter("id"));

    Usuario usu = control.traerUsuario(id);
    if (usu != null) {
        usu.setName(request.getParameter("name"));
        usu.setEmail(request.getParameter("email"));
        usu.setDireccion(request.getParameter("direccion"));
        usu.setTelefono(request.getParameter("telefono"));
        usu.setTipo_documento(request.getParameter("tipo_documento"));
        usu.setDocumento(request.getParameter("documento"));
        usu.setFecha(request.getParameter("fecha"));

        // Conversión del nombre de rol a objeto Rol
        String nombreRol = request.getParameter("rol");
        Rol rol = control.traerRolPorNombre(nombreRol);
        usu.setRol(rol);

        control.editarUsuario(usu); // Actualiza en la base de datos
    }

    response.sendRedirect("SvUsuario");
}

@Override
protected void doGet(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
    // Opcional: podrías redirigir o mostrar un mensaje si alguien entra por GET
    response.getWriter().println("Acceso no permitido por GET");
}
}