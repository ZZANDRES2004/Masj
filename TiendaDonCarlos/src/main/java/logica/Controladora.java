package logica;

import java.util.List;
import persistencia.ControladoraPersistencia;
import java.util.Date;

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
            usu.setActivo(false);
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

    // CLIENTES
    public void crearCliente(Cliente cli) {
        controlPersis.crearCliente(cli);
    }

    public List<Cliente> traerClientes() {
        return controlPersis.traerClientes();
    }

   public Cliente buscarCliente(int id) {
    return controlPersis.buscarCliente(id);
}
   
public void registrarCredito(Cliente cliente, Usuario usuario, double monto, int limiteDias) {
    Credito credito = new Credito();
    credito.setCliente(cliente);
    credito.setUsuario(usuario);
    credito.setMontoTotal(monto);
    credito.setFechaEmision(new Date());

    // Calcula fecha de vencimiento
    Date fechaVencimiento = new Date(System.currentTimeMillis() + (limiteDias * 86400000L));
    credito.setFechaVencimiento(fechaVencimiento);

    credito.setLimiteDiasCredito(limiteDias);
    credito.setEstado("Vigente");

    controlPersis.crearCredito(credito);
}

   
}
