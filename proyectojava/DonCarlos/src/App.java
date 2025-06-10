import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

public class App {
    public static void main(String[] args) {
        String url = "jdbc:mysql://localhost:3306/tienda_creditos"; 
        String usuario = "root";
        String contraseña = "";

        try {
            // Conectarse
            Connection conexion = DriverManager.getConnection(url, usuario, contraseña);
            System.out.println("Conectado a la base de datos");

            // Crear una consulta
            Statement stmt = conexion.createStatement();
            ResultSet rs = stmt.executeQuery("SELECT * FROM usuario");

            // Recorrer los resultados
            while (rs.next()) {
                System.out.println("ID: " + rs.getInt("id") + " - Nombre: " + rs.getString("nombre"));
            }

            // Cerrar conexión
            rs.close();
            stmt.close();
            conexion.close();

        } catch (Exception e) {
            System.out.println("Error de conexión: " + e.getMessage());
        }
    }
}
