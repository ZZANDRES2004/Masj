package controller;

import java.sql.*;
import com.google.gson.*;

import com.sun.net.httpserver.*;

import java.io.*;
import java.net.InetSocketAddress;

public class LoginController {
    public static void main(String[] args) throws IOException {
        // Puerto cambiado a 8081
        HttpServer server = HttpServer.create(new InetSocketAddress(8081), 0);

        server.createContext("/login", new LoginHandler());
        server.setExecutor(null);
        server.start();
        System.out.println("✅ Servidor corriendo en http://localhost:8081");
    }

    static class LoginHandler implements HttpHandler {
        @Override
        public void handle(HttpExchange exchange) throws IOException {
            // Preflight CORS
            if (exchange.getRequestMethod().equalsIgnoreCase("OPTIONS")) {
                addCORSHeaders(exchange);
                exchange.sendResponseHeaders(204, -1);
                return;
            }

            if (!exchange.getRequestMethod().equalsIgnoreCase("POST")) {
                exchange.sendResponseHeaders(405, -1);
                return;
            }

            InputStreamReader isr = new InputStreamReader(exchange.getRequestBody(), "utf-8");
            BufferedReader reader = new BufferedReader(isr);
            StringBuilder body = new StringBuilder();
            String line;
            while ((line = reader.readLine()) != null) {
                body.append(line);
            }

            JsonObject json = JsonParser.parseString(body.toString()).getAsJsonObject();
            String usuario = json.get("usuario").getAsString();
            String contrasena = json.get("contrasena").getAsString();

            JsonObject response = new JsonObject();

            try (Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/tienda_creditos", "root", "")) {
                PreparedStatement stmt = conn.prepareStatement(
                    "SELECT u.nombre, r.nombre AS rol FROM Usuario u " +
                    "JOIN Usuario_Rol ur ON u.id = ur.usuario_id " +
                    "JOIN Rol r ON ur.rol_id = r.id " +
                    "WHERE u.usuario = ? AND u.contrasena = ? LIMIT 1"
                );
                stmt.setString(1, usuario);
                stmt.setString(2, contrasena);
                ResultSet rs = stmt.executeQuery();

                if (rs.next()) {
                    String nombre = rs.getString("nombre");
                    String rol = rs.getString("rol");

                    response.addProperty("success", true);
                    response.addProperty("nombre", nombre);
                    response.addProperty("rol", rol);
                    response.addProperty("redirectUrl", rol.equalsIgnoreCase("admin") ? "admin_dashboard.html" : "inicio.html");
                } else {
                    response.addProperty("success", false);
                    response.addProperty("message", "Credenciales inválidas o usuario sin rol");
                }

            } catch (SQLException e) {
                response.addProperty("success", false);
                response.addProperty("message", "Error al conectar a la base de datos: " + e.getMessage());
                e.printStackTrace(); // Para debug
            }

            byte[] respBytes = response.toString().getBytes("UTF-8");

            // Cabeceras CORS finales
            addCORSHeaders(exchange);
            exchange.getResponseHeaders().add("Content-Type", "application/json");

            exchange.sendResponseHeaders(200, respBytes.length);
            OutputStream os = exchange.getResponseBody();
            os.write(respBytes);
            os.close();
        }

        private void addCORSHeaders(HttpExchange exchange) {
            exchange.getResponseHeaders().add("Access-Control-Allow-Origin", "*");
            exchange.getResponseHeaders().add("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
            exchange.getResponseHeaders().add("Access-Control-Allow-Headers", "Content-Type");
        }
    }
}
