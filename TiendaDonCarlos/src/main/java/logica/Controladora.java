package logica;

import java.util.List;
import persistencia.ControladoraPersistencia;

public class Controladora {

    ControladoraPersistencia controlPersis = new ControladoraPersistencia();

    public void crearUsuario(Usuario usu) {
        controlPersis.crearUsuario(usu);
    }

    public List<Usuario> traerUsuarios() {
        return controlPersis.traerUsuarios();
    }

    public Usuario traerUsuario(int id) {
        return controlPersis.traerUsuario(id);
    }

    public void editarUsuario(Usuario usu) {
        controlPersis.editarUsuario(usu);
    }

    public Rol traerRolPorNombre(String nombre) {
        return controlPersis.traerRolPorNombre(nombre);
    }

    public Usuario traerUsuarioPorEmail(String email) {
        return controlPersis.traerUsuarioPorEmail(email);
    }

    public void eliminarUsuario(int id) {
        controlPersis.eliminarUsuario(id);
    }

    public void inhabilitarUsuario(int id) {
        Usuario usu = controlPersis.traerUsuario(id);
        if (usu != null) {
            usu.setActivo(false); // Suponiendo que tienes un atributo booleano "activo"
            controlPersis.modificarUsuario(usu);
        }
    }

    public void activarUsuario(int id) {
        Usuario usu = controlPersis.traerUsuario(id);
        if (usu != null) {
            usu.setActivo(true);
            controlPersis.modificarUsuario(usu);
        }
    }
    public void crearCliente(Cliente cli) {
    controlPersis.crearCliente(cli);
}


}
