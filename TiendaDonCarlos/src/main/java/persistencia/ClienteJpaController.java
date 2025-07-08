package persistencia;

import java.io.Serializable;
import java.util.List;
import javax.persistence.*;
import logica.Cliente;
import javax.persistence.criteria.CriteriaBuilder;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;


public class ClienteJpaController implements Serializable {

    private EntityManagerFactory emf = Persistence.createEntityManagerFactory("TiendaDonCarlosPU");

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(Cliente cliente) {
    EntityManager em = null;
    try {
        em = getEntityManager();
        em.getTransaction().begin();
        em.persist(cliente);
        em.getTransaction().commit();
        System.out.println("✅ Cliente guardado en la BD");
    } catch (Exception e) {
        e.printStackTrace();
    } finally {
        if (em != null) em.close();
    }
}


    public void edit(Cliente cliente) throws Exception {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            cliente = em.merge(cliente);
            em.getTransaction().commit();
        } catch (Exception ex) {
            throw new Exception("Error al editar cliente", ex);
        } finally {
            if (em != null) em.close();
        }
    }

    public void destroy(int id) throws Exception {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            Cliente cliente;
            try {
                cliente = em.getReference(Cliente.class, id);
                cliente.getId();
            } catch (EntityNotFoundException enfe) {
                throw new Exception("El cliente con ID " + id + " no existe.", enfe);
            }
            em.remove(cliente);
            em.getTransaction().commit();
        } finally {
            if (em != null) em.close();
        }
    }

    public Cliente findCliente(int id) {
        EntityManager em = getEntityManager();
        try {
            return em.find(Cliente.class, id);
        } finally {
            em.close();
        }
    }

    public List<Cliente> findClienteEntities() {
    EntityManager em = getEntityManager();
    try {
        CriteriaBuilder cb = em.getCriteriaBuilder();
        CriteriaQuery<Cliente> cq = cb.createQuery(Cliente.class);
        Root<Cliente> root = cq.from(Cliente.class);
        cq.select(root);
        
        return em.createQuery(cq).getResultList();
    } finally {
        em.close();
    }
}

}
