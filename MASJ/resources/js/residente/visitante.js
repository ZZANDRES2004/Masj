document.addEventListener('DOMContentLoaded', function () {
    const link = document.querySelector('[data-section="visitantes"]');
    if (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            fetch('views/visitantes.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('content-panel').innerHTML = data;
                });
        });
    }
});
