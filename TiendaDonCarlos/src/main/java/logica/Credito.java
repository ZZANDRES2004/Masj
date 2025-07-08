package logica;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.*;

@Entity
public class Credito implements Serializable {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;

    @ManyToOne
    private Cliente cliente;

    @ManyToOne
    private Usuario usuario;

    private double montoTotal;

    @Temporal(TemporalType.DATE)
    private Date fechaEmision;

    @Temporal(TemporalType.DATE)
    private Date fechaVencimiento;

    private int limiteDiasCredito;

    private String estado = "Vigente";

    // Getters y setters
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public Cliente getCliente() { return cliente; }
    public void setCliente(Cliente cliente) { this.cliente = cliente; }

    public Usuario getUsuario() { return usuario; }
    public void setUsuario(Usuario usuario) { this.usuario = usuario; }

    public double getMontoTotal() { return montoTotal; }
    public void setMontoTotal(double montoTotal) { this.montoTotal = montoTotal; }

    public Date getFechaEmision() { return fechaEmision; }
    public void setFechaEmision(Date fechaEmision) { this.fechaEmision = fechaEmision; }

    public Date getFechaVencimiento() { return fechaVencimiento; }
    public void setFechaVencimiento(Date fechaVencimiento) { this.fechaVencimiento = fechaVencimiento; }

    public int getLimiteDiasCredito() { return limiteDiasCredito; }
    public void setLimiteDiasCredito(int limiteDiasCredito) { this.limiteDiasCredito = limiteDiasCredito; }

    public String getEstado() { return estado; }
    public void setEstado(String estado) { this.estado = estado; }
}

