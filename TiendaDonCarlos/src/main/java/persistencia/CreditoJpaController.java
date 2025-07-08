package persistencia;

import java.io.Serializable;
import javax.persistence.*;
import logica.Credito;

public class CreditoJpaController implements Serializable {

    private EntityManagerFactory emf = Persistence.createEntityManagerFactory("TiendaDonCarlosPU");

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(Credito credito) {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            em.persist(credito);
            em.getTransaction().commit();
            System.out.println("✅ Crédito registrado correctamente");
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (em != null) em.close();
        }
    }
}
