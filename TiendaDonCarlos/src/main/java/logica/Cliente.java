package logica;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.*;

@Entity
@Table(name = "cliente")
public class Cliente implements Serializable {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;

    private String nombre;

    private String direccion;

    private String telefono;

    private String email;

    @Column(name = "documento_identidad")
    private String documentoIdentidad;

    @Column(name = "categoria_crediticia")
    private String categoriaCrediticia;

    @Column(name = "limite_credito")
    private double limiteCredito;

    @Temporal(TemporalType.TIMESTAMP)
    @Column(name = "fecha_registro")
    private Date fechaRegistro;

    // Getters y Setters...
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getNombre() { return nombre; }
    public void setNombre(String nombre) { this.nombre = nombre; }

    public String getDireccion() { return direccion; }
    public void setDireccion(String direccion) { this.direccion = direccion; }

    public String getTelefono() { return telefono; }
    public void setTelefono(String telefono) { this.telefono = telefono; }

    public String getEmail() { return email; }
    public void setEmail(String email) { this.email = email; }

    public String getDocumentoIdentidad() { return documentoIdentidad; }
    public void setDocumentoIdentidad(String documentoIdentidad) { this.documentoIdentidad = documentoIdentidad; }

    public String getCategoriaCrediticia() { return categoriaCrediticia; }
    public void setCategoriaCrediticia(String categoriaCrediticia) { this.categoriaCrediticia = categoriaCrediticia; }

    public double getLimiteCredito() { return limiteCredito; }
    public void setLimiteCredito(double limiteCredito) { this.limiteCredito = limiteCredito; }

    public Date getFechaRegistro() { return fechaRegistro; }
    public void setFechaRegistro(Date fechaRegistro) { this.fechaRegistro = fechaRegistro; }
}
