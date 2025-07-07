package com.mycompany.tiendadoncarlos.Servlets;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.util.ArrayList;
import java.util.List;
import logica.Controladora;
import logica.Rol;
import logica.Usuario;

@WebServlet(name = "SvUsuario", urlPatterns = {"/SvUsuario"})
public class SvUsuario extends HttpServlet {

    Controladora control = new Controladora();

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        List<Usuario> listaUsuarios = new ArrayList<>();
        listaUsuarios = control.traerUsuarios();

        HttpSession misesion = request.getSession();
        misesion.setAttribute("listaUsuarios", listaUsuarios);

        response.sendRedirect("adminUsuarios.jsp");
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        String name = request.getParameter("name");
        String email = request.getParameter("email");
        String password = request.getParameter("password");
        String direccion = request.getParameter("direccion");
        String telefono = request.getParameter("telefono");
        String tipo_documento = request.getParameter("tipo_documento");
        String documento = request.getParameter("documento");
        String fecha = request.getParameter("fecha");

        Usuario usu = new Usuario();
        usu.setName(name);
        usu.setEmail(email);
        usu.setPassword(password);
        usu.setDireccion(direccion);
        usu.setTelefono(telefono);
        usu.setTipo_documento(tipo_documento);
        usu.setDocumento(documento);
        usu.setFecha(fecha);

        Rol rolCliente = control.traerRolPorNombre("cliente");
        usu.setRol(rolCliente);

        control.crearUsuario(usu);
        
              response.sendRedirect("login.jsp");
    }

    @Override
    public String getServletInfo() {
        return "Short description";
    }

}
