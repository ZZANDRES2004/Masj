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

    public Rol traerRolPorNombre(String nombre) {
    return controlPersis.traerRolPorNombre(nombre);
}

    public Usuario traerUsuarioPorEmail(String email) {
    return controlPersis.traerUsuarioPorEmail(email);
}
   
}
