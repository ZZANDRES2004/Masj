<%@page import="java.util.List"%>
<%@page import="logica.Usuario"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>lista de usuarios registrados</h1>
        
        <% 
            List <Usuario> listaUsuarios = (List) request.getSession().getAttribute("listaUsuarios");
             int cont =1;
            for(Usuario usu : listaUsuarios) {
        %>
        
                <p><b>Usuarios N° <%=cont%></b></p>
                <p>Email: <%=usu.getEmail()%></p>
                <p>Contraseña: <%=usu.getPassword()%></p>
                <p>------------------------------------</p>
                <% cont = cont + 1;%>
        <%}%>
        
    </body>
</html>
