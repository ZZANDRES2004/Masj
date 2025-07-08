<%@page import="logica.Cliente"%>
<%@page import="logica.ClienteCredito"%>
<%@page import="java.util.List"%>
<%@page import="logica.Controladora"%>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrar Crédito</title>
    <link rel="stylesheet" type="text/css" href="css/estiloCredito.css">
</head>
<body>
    <h1>Registrar Crédito</h1>
    
    <form action="SvRegistrarCredito" method="post">
        <label for="clienteId">Cliente:</label>
        <select name="clienteId" required>
          <%
        Controladora control = new Controladora();
        List<Cliente> listaClientes = control.traerClientes(); // <- USA Cliente
        for (Cliente cli : listaClientes) {
    %>
                <option value="<%= cli.getId() %>">
                    <%= cli.getNombre() %> - ID: <%= cli.getId() %>
                </option>
            <%
                }
            %>
        </select>
        <br><br>

        <label for="monto">Monto del Crédito:</label>
        <input type="number" name="monto" step="0.01" required>
        <br><br>

        <label for="limiteDias">Límite en días:</label>
        <input type="number" name="limiteDias" required>
        <br><br>

        <input type="submit" value="Registrar Crédito">
    </form>
</body>
</html>