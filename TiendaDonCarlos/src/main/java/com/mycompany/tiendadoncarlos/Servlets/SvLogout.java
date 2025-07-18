package com.mycompany.tiendadoncarlos.Servlets;


import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@WebServlet(name = "SvLogout", urlPatterns = {"/SvLogout"})
public class SvLogout extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        HttpSession session = request.getSession(false); // no crea si no existe
        if (session != null) {
            session.invalidate(); // elimina la sesión
        }
        response.sendRedirect("login.jsp");
    }
}
