package persistencia;

import java.util.List;
import logica.Rol;
import logica.Usuario;

public class ControladoraPersistencia {

    UsuarioJpaController usuJpa = new UsuarioJpaController();
    RolJpaController rolJpa = new RolJpaController();

    //operacion Create
    public void crearUsuario(Usuario usu) {
        usuJpa.create(usu);
    }

    //operación Read
    public List<Usuario> traerUsuarios() {
        return usuJpa.findUsuarioEntities();
    }

    public Rol traerRolPorNombre(String nombre) {
        return rolJpa.findRolByNombre(nombre);
    }

    public Usuario traerUsuarioPorEmail(String email) {
        return usuJpa.traerUsuarioPorEmail(email);
    }

    public void eliminarUsuario(int id) {
        try {
            usuJpa.destroy(id);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public Usuario traerUsuario(int id) {
        return usuJpa.findUsuario(id);
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
        usuJpa.edit(usu); // esto guarda en base de datos
    } catch (Exception e) {
        e.printStackTrace();
    }
}
   public void crearCliente(logica.Cliente cli) {
    ClienteJpaController clienteJPA = new ClienteJpaController();
    try {
        clienteJPA.create(cli);
    } catch (Exception e) {
        e.printStackTrace();
    }
}



}
