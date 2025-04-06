document.addEventListener('DOMContentLoaded', function () {
    const link = document.querySelector('[data-section="correspondencia"]');

    if (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            fetch('../views/correspondencia.php')

                .then(response => response.text())
                .then(data => {
                    document.getElementById('content-panel').innerHTML = data;
                    // Muy importante: activar eventos después de cargar HTML
                    activarEventosCorrespondencia();
                });
        });
    }
});

function activarEventosCorrespondencia() {
    document.querySelectorAll('.toggle-novedad').forEach(btn => {
        btn.addEventListener('click', function () {
            const index = this.dataset.index;
            const form = document.getElementById('novedad-form-' + index);
            if (form) form.style.display = 'block';
        });
    });

    document.querySelectorAll('.cancelar-novedad').forEach(btn => {
        btn.addEventListener('click', function () {
            const index = this.dataset.index;
            const form = document.getElementById('novedad-form-' + index);
            if (form) form.style.display = 'none';
        });
    });

    document.querySelectorAll('.enviar-novedad').forEach(btn => {
        btn.addEventListener('click', function () {
            const index = this.dataset.index;
            const textarea = document.querySelector(`#novedad-form-${index} textarea`);
            if (textarea) {
                alert('Novedad enviada:\n' + textarea.value);
                // Aquí iría una petición AJAX si deseas guardar la novedad
                document.getElementById('novedad-form-' + index).style.display = 'none';
            }
        });
    });
}
