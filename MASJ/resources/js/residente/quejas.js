document.addEventListener('DOMContentLoaded', function () {
    // Delegamos el click sobre todos los enlaces con data-section
    document.querySelectorAll('[data-section="quejas"]').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            fetch('/quejas')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('content-panel').innerHTML = data;

                    const nuevaQuejaBtn = document.getElementById('nueva-queja-btn');
                    const nuevaQuejaForm = document.getElementById('nueva-queja-form');
                    const cancelarQuejaBtn = document.getElementById('cancelar-queja-btn');

                    if (nuevaQuejaBtn && nuevaQuejaForm && cancelarQuejaBtn) {
                        nuevaQuejaBtn.addEventListener('click', function () {
                            nuevaQuejaForm.style.display = 'block';
                        });

                        cancelarQuejaBtn.addEventListener('click', function () {
                            nuevaQuejaForm.style.display = 'none';
                        });
                    }
                });
        });
    });
});
