
package persistencia;

import java.util.List;
import logica.Usuario;


public class ControladoraPersistencia {
    
    
    UsuarioJpaController usuJpa = new UsuarioJpaController ();
    
    //operacion Create
    public void crearUsuario (Usuario usu) {
        usuJpa.create(usu);
    }
    
    //operación Read
    public List<Usuario> traerUsuarios () {
        return usuJpa.findUsuarioEntities();
    }
}
