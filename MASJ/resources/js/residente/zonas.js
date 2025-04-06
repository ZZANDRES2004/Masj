document.addEventListener('DOMContentLoaded', function () {
    const link = document.querySelector('[data-section="zonas-comunes"]');
    if (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            fetch('zonas_comunes.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('content-panel').innerHTML = data;

                    // Agrega lógica después de cargar el contenido
                    const btnNueva = document.getElementById('nueva-reserva-btn');
                    const form = document.getElementById('reservas-form');
                    const btnCancelar = document.getElementById('cancelar-reserva-btn');

                    if (btnNueva && form) { 
                        btnNueva.addEventListener('click', () => {
                            form.style.display = 'block';
                            btnNueva.style.display = 'none';
                        });
                    }

                    if (btnCancelar && form) {
                        btnCancelar.addEventListener('click', () => {
                            form.style.display = 'none';
                            btnNueva.style.display = 'inline-block';
                        });
                    }
                });
        });
    }
});
