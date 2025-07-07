
package persistencia;

import java.util.List;
import logica.Rol;
import logica.Usuario;


public class ControladoraPersistencia {
    
    
    UsuarioJpaController usuJpa = new UsuarioJpaController ();
    RolJpaController rolJpa = new RolJpaController();

    
    //operacion Create
    public void crearUsuario (Usuario usu) {
        usuJpa.create(usu);
    }
    
    //operación Read
    public List<Usuario> traerUsuarios () {
        return usuJpa.findUsuarioEntities();
    }
    
   public Rol traerRolPorNombre(String nombre) {
    return rolJpa.findRolByNombre(nombre);
}

public Usuario traerUsuarioPorEmail(String email) {
    return usuJpa.traerUsuarioPorEmail(email);
}

}
