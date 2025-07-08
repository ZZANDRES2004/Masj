package persistencia;

import java.util.List;
import logica.Cliente;
import logica.Credito;
import logica.Rol;
import logica.Usuario;

public class ControladoraPersistencia {

    UsuarioJpaController usuJpa = new UsuarioJpaController();
    RolJpaController rolJpa = new RolJpaController();
    ClienteJpaController clienteJpa = new ClienteJpaController();
    CreditoJpaController creditoJpa = new CreditoJpaController();

    // Usuario
    public void crearUsuario(Usuario usu) {
        usuJpa.create(usu);
    }

    public List<Usuario> traerUsuarios() {
        return usuJpa.findUsuarioEntities();
    }

    public Rol traerRolPorNombre(String nombre) {
        return rolJpa.findRolByNombre(nombre);
    }

    public Usuario traerUsuarioPorEmail(String email) {
        return usuJpa.traerUsuarioPorEmail(email);
    }

    public Usuario traerUsuario(int id) {
        return usuJpa.findUsuario(id);
    }

    public void eliminarUsuario(int id) {
        try {
            usuJpa.destroy(id);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void modificarUsuario(Usuario usu) {
        try {
            usuJpa.edit(usu);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void editarUsuario(Usuario usu) {
        try {
            usuJpa.edit(usu);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    // Cliente
    public void crearCliente(Cliente cli) {
        try {
            clienteJpa.create(cli);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public List<Cliente> traerClientes() {
        return clienteJpa.findClienteEntities();
    }

    public Cliente buscarCliente(int id) {
        return clienteJpa.findCliente(id);
    }

    // Crédito
    public void crearCredito(Credito credito) {
        try {
            creditoJpa.create(credito);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
