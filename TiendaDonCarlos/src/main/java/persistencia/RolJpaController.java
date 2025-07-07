package persistencia;

import java.io.Serializable;
import java.util.List;
import javax.persistence.*;
import javax.persistence.criteria.CriteriaQuery;
import logica.Rol;

public class RolJpaController implements Serializable {

    private EntityManagerFactory emf = Persistence.createEntityManagerFactory("TiendaDonCarlosPU");

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(Rol rol) {
        EntityManager em = getEntityManager();
        try {
            em.getTransaction().begin();
            em.persist(rol);
            em.getTransaction().commit();
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void edit(Rol rol) throws Exception {
        EntityManager em = getEntityManager();
        try {
            em.getTransaction().begin();
            rol = em.merge(rol);
            em.getTransaction().commit();
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void destroy(int id) throws Exception {
        EntityManager em = getEntityManager();
        try {
            em.getTransaction().begin();
            Rol rol = em.getReference(Rol.class, id);
            em.remove(rol);
            em.getTransaction().commit();
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public Rol findRol(int id) {
        EntityManager em = getEntityManager();
        try {
            return em.find(Rol.class, id);
        } finally {
            em.close();
        }
    }

    public List<Rol> findRolEntities() {
        return findRolEntities(true, -1, -1);
    }

    public List<Rol> findRolEntities(int maxResults, int firstResult) {
        return findRolEntities(false, maxResults, firstResult);
    }

    private List<Rol> findRolEntities(boolean all, int maxResults, int firstResult) {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery<Rol> cq = em.getCriteriaBuilder().createQuery(Rol.class);
            cq.select(cq.from(Rol.class));
            TypedQuery<Rol> q = em.createQuery(cq);
            if (!all) {
                q.setMaxResults(maxResults);
                q.setFirstResult(firstResult);
            }
            return q.getResultList();
        } finally {
            em.close();
        }
    }

    public Rol findRolByNombre(String nombre) {
    EntityManager em = getEntityManager();
    try {
        TypedQuery<Rol> q = em.createQuery("SELECT r FROM Rol r WHERE r.nombre = :nombre", Rol.class);
        q.setParameter("nombre", nombre);
        List<Rol> resultados = q.getResultList();
        return resultados.isEmpty() ? null : resultados.get(0);
    } finally {
        em.close();
    }
}

}
    