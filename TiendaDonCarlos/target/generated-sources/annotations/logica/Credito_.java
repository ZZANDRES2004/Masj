package logica;

import java.util.Date;
import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;
import logica.Cliente;
import logica.Usuario;

@Generated(value="EclipseLink-2.7.12.v20230209-rNA", date="2025-07-07T22:25:32")
@StaticMetamodel(Credito.class)
public class Credito_ { 

    public static volatile SingularAttribute<Credito, Cliente> cliente;
    public static volatile SingularAttribute<Credito, String> estado;
    public static volatile SingularAttribute<Credito, Date> fechaVencimiento;
    public static volatile SingularAttribute<Credito, Integer> limiteDiasCredito;
    public static volatile SingularAttribute<Credito, Usuario> usuario;
    public static volatile SingularAttribute<Credito, Date> fechaEmision;
    public static volatile SingularAttribute<Credito, Integer> id;
    public static volatile SingularAttribute<Credito, Double> montoTotal;

}