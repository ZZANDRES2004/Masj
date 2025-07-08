package com.mycompany.tiendadoncarlos.Servlets;

import java.io.IOException;

import java.util.Date;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;
import logica.Cliente;
import logica.Controladora;

@WebServlet(name = "SvRegistrarCliente", urlPatterns = {"/SvRegistrarCliente"})
public class SvRegistrarCliente extends HttpServlet {

    Controladora control = new Controladora();

   @Override
protected void doPost(HttpServletRequest request, HttpServletResponse response)
        throws ServletException, IOException {

    String nombre = request.getParameter("nombre");
    String direccion = request.getParameter("direccion");
    String telefono = request.getParameter("telefono");
    String email = request.getParameter("email");
    String documento = request.getParameter("documento");
    String categoria = request.getParameter("categoria");
    String limite = request.getParameter("limite");

    System.out.println("✅ Datos recibidos:");
    System.out.println("Nombre: " + nombre);
    System.out.println("Dirección: " + direccion);
    System.out.println("Teléfono: " + telefono);
    System.out.println("Email: " + email);
    System.out.println("Documento: " + documento);
    System.out.println("Categoría: " + categoria);
    System.out.println("Límite: " + limite);

    try {
        Cliente cli = new Cliente();
        cli.setNombre(nombre);
        cli.setDireccion(direccion);
        cli.setTelefono(telefono);
        cli.setEmail(email);
        cli.setDocumentoIdentidad(documento);
        cli.setCategoriaCrediticia(categoria);
        cli.setLimiteCredito(Double.parseDouble(limite));
        cli.setFechaRegistro(new Date()); // <-- este import es java.util.Date


        control.crearCliente(cli);

        System.out.println("✅ Cliente enviado a la controladora.");
    } catch (Exception e) {
        e.printStackTrace();
        System.out.println("❌ Error creando cliente: " + e.getMessage());
    }

    response.sendRedirect("Cliente.jsp");
}

}
