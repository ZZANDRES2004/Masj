package com.mycompany.tiendadoncarlos.Servlets;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;
import logica.Cliente;
import logica.Controladora;
import logica.Usuario;

@WebServlet(name = "SvRegistrarCredito", urlPatterns = {"/SvRegistrarCredito"})
public class SvRegistrarCredito extends HttpServlet {

    Controladora control = new Controladora();

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        int clienteId = Integer.parseInt(request.getParameter("clienteId"));
        double monto = Double.parseDouble(request.getParameter("monto"));
        int limiteDias = Integer.parseInt(request.getParameter("limiteDias"));

        Cliente cliente = control.buscarCliente(clienteId); // ← aquí corregido

        HttpSession session = request.getSession();
        Usuario usuario = (Usuario) session.getAttribute("usuario");

        control.registrarCredito(cliente, usuario, monto, limiteDias);

        response.sendRedirect("adminUsuarios.jsp");
    }
}

