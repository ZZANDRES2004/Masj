package com.mycompany.tiendadoncarlos.Servlets;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import logica.Controladora;
import logica.Usuario;

@WebServlet(name = "SvUsuarioInhabilitar", urlPatterns = {"/SvUsuarioInhabilitar"})
public class SvUsuarioInhabilitar extends HttpServlet {

    Controladora control = new Controladora();

    @Override
protected void doPost(HttpServletRequest request, HttpServletResponse response)
        throws ServletException, IOException {

    int id = Integer.parseInt(request.getParameter("id"));
    Usuario usu = control.traerUsuario(id);

    // Invertir el estado actual
    usu.setActivo(!usu.isActivo());

    control.editarUsuario(usu);

    response.sendRedirect("SvUsuario");
}

}
