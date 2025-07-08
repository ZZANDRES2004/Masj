package logica;

import java.util.List;
import persistencia.ClienteJpaController;
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
   
    public void crearCliente(Cliente cli) {
    ClienteJpaController clienteJPA = new ClienteJpaController(); // o la instancia compartida si la tienes
    try {
        clienteJPA.create(cli);
    } catch (Exception e) {
        e.printStackTrace();
    }
}

}
