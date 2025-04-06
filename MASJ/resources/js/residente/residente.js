document.addEventListener('DOMContentLoaded', function() {
    // Referencias a los elementos
    const contentPanel = document.getElementById('content-panel');
    const navLinks = document.querySelectorAll('.nav-link');
    const sidebarLinks = document.querySelectorAll('.sidebar-link');

    // Función para cargar contenido
    function loadContent(section) {
        // Quitar clases activas
        navLinks.forEach(link => link.classList.remove('active'));
        sidebarLinks.forEach(link => link.classList.remove('active'));

        // Añadir clase activa al enlace correspondiente
        document.querySelectorAll(`[data-section="${section}"]`).forEach(link => {
            link.classList.add('active');
        });

        // Si es dashboard, mostrar el contenido inicial
        if (section === 'dashboard') {
            contentPanel.innerHTML = document.getElementById('dashboard-content').innerHTML;
            return;
        }

        // Para otras secciones, cargar el contenido con AJAX
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                // Extraer solo el contenido relevante del HTML devuelto
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = this.responseText;

                // Buscar el contenido específico que necesitamos
                const contentDiv = tempDiv.querySelector('.content-panel');

                if (contentDiv) {
                    contentPanel.innerHTML = contentDiv.innerHTML;
                } else {
                    contentPanel.innerHTML = this.responseText;
                }

                // Ejecutar scripts en el contenido cargado
                const scripts = contentPanel.querySelectorAll('script');
                scripts.forEach(script => {
                    const newScript = document.createElement('script');
                    if (script.src) {
                        newScript.src = script.src;
                    } else {
                        newScript.textContent = script.textContent;
                    }
                    document.body.appendChild(newScript);
                });
            }
        };

        // Abrir la URL correspondiente a la sección
        xhr.open('GET', `${section}.php`, true);
        xhr.send();
    }

    // Asignar evento de clic a los enlaces de navegación
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const section = this.getAttribute('data-section');
            loadContent(section);
        });
    });

    // Asignar evento de clic a los enlaces de la barra lateral
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const section = this.getAttribute('data-section');
            loadContent(section);
        });
    });

    // Guardar el contenido original del dashboard
    const dashboardHTML = document.getElementById('content-panel').innerHTML;
    const dashboardContent = document.createElement('div');
    dashboardContent.id = 'dashboard-content';
    dashboardContent.style.display = 'none';
    dashboardContent.innerHTML = dashboardHTML;
    document.body.appendChild(dashboardContent);
    
    // Dropdown de usuario
    const toggle = document.getElementById('user-dropdown-toggle');
    const menu = document.getElementById('user-dropdown-menu');

    if (toggle && menu) {
        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            menu.classList.toggle('show');
        });

        document.addEventListener('click', function (e) {
            if (!menu.contains(e.target) && !toggle.contains(e.target)) {
                menu.classList.remove('show');
            }
        });
    }
});