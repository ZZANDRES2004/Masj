// --- Lógica de JavaScript para la navegación de la barra lateral ---
        document.addEventListener('DOMContentLoaded', function () {
            const navLinks = document.querySelectorAll('.nave li'); // Selecciona los <li> dentro de .nave
            const contentSections = document.querySelectorAll('.content-section');
            const pageTitleHeader = document.getElementById('page-title-header'); // Para actualizar el título del header

            // Función para mostrar una sección (o todas para el dashboard) y ocultar las demás
            function showSection(targetId) {
                let currentSectionTitle = "Vista General"; // Título por defecto para el dashboard

                if (targetId === 'dashboard-content') {
                    // Cuando es el Dashboard, mostrar todas las secciones
                    contentSections.forEach(section => {
                        section.classList.remove('hidden'); // Quita 'hidden' de todas
                        // Si la sección de reportes es una de las que se muestra, inicializar su gráfico
                        if (section.id === 'reportes-content' && typeof initChart === 'function') {
                            setTimeout(initChart, 50); // Delay para asegurar visibilidad
                        }
                    });
                    if (pageTitleHeader) {
                        pageTitleHeader.textContent = `Bienvenido, [Nombre del Usuario] - ${currentSectionTitle}`;
                    }
                } else {
                    // Para cualquier otra pestaña, mostrar solo la sección específica
                    contentSections.forEach(section => {
                        if (section.id === targetId) {
                            section.classList.remove('hidden');
                            const h3Title = section.querySelector('h3');
                            if (h3Title) {
                                currentSectionTitle = h3Title.textContent.replace(/^[📈📊⚠👤⚙️]\s*/, '').trim();
                            }
                            // Si la sección de reportes es la seleccionada, inicializar su gráfico
                            if (targetId === 'reportes-content' && typeof initChart === 'function') {
                                setTimeout(initChart, 50);
                            }
                        } else {
                            section.classList.add('hidden');
                        }
                    });
                    if (pageTitleHeader) {
                        pageTitleHeader.textContent = `Bienvenido, [Nombre del Usuario] - ${currentSectionTitle}`;
                    }
                }
            }

            // Añadir event listeners a los enlaces de navegación
            navLinks.forEach(link => {
                link.addEventListener('click', function () {
                    const targetId = this.dataset.target;
                    if (!targetId) {
                        console.warn("Elemento de navegación sin data-target:", this);
                        return; 
                    }

                    navLinks.forEach(nav => nav.classList.remove('active-link'));
                    this.classList.add('active-link');
                    showSection(targetId);
                });
            });

            // Mostrar la sección/vista por defecto al cargar la página
            const defaultActiveLink = document.querySelector('.nave li.active-link');
            if (defaultActiveLink && defaultActiveLink.dataset.target) {
                 showSection(defaultActiveLink.dataset.target);
            } else if (navLinks.length > 0 && navLinks[0].dataset.target) {
                navLinks[0].classList.add('active-link');
                showSection(navLinks[0].dataset.target);
            } else {
                console.warn("No se pudo determinar la sección por defecto a mostrar.");
            }
        });

        // --- Lógica original de admin.js para la gráfica (Adaptada) ---
        let chartInstance; 
        let profitData = { 
            labels: [],
            datasets: [{
                label: 'Ganancias ($)',
                data: [],
                backgroundColor: 'rgba(102, 126, 234, 0.2)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 3,
                fill: false, 
                tension: 0.4,
                pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        };

        function initChart() {
            const ctx = document.getElementById('profitChart');
            if (!ctx || !ctx.offsetParent) {
                return;
            }
            if (chartInstance) {
                chartInstance.destroy(); 
            }
            chartInstance = new Chart(ctx.getContext('2d'), {
                type: 'line', 
                data: profitData, 
                options: { 
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true, position: 'top', labels: { usePointStyle: true, padding: 20, font: { size: 14, weight: 'bold' } } },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)', titleColor: 'white', bodyColor: 'white',
                            borderColor: 'rgba(102, 126, 234, 1)', borderWidth: 1, cornerRadius: 10, displayColors: false,
                            callbacks: { label: function(context) { return `Ganancia: $${context.parsed.y.toLocaleString()}`; } }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0, 0, 0, 0.1)', drawBorder: false }, ticks: { callback: function(value) { return '$' + value.toLocaleString(); }, font: { size: 12 } } },
                        x: { grid: { display: false }, ticks: { font: { size: 12 } } }
                    },
                    interaction: { intersect: false, mode: 'index' },
                    animation: { duration: 1000, easing: 'easeInOutQuart' }
                }
            });
            if (profitData.labels.length === 0 && profitData.datasets[0].data.length === 0) {
                generateSampleChartData('month'); 
            } else {
                chartInstance.update(); 
            }
        }

        function generateSampleChartData(period = 'month') {
            let labels, data;
            if (period === 'week') {
                labels = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
                data = [1200, 1500, 1300, 1700, 1600, 1900, 1800];
            } else if (period === 'year') {
                labels = ['T1', 'T2', 'T3', 'T4'];
                data = [45000, 52000, 48000, 55000];
            } else { 
                labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'];
                data = [15000, 18000, 22000, 19000, 25000, 28000];
            }
            profitData.labels = labels;
            profitData.datasets[0].data = data;
            if (chartInstance) {
                chartInstance.update(); 
            }
            updateChartStatsMini(); 
        }

        function changeChartView(period) {
            generateSampleChartData(period);
        }

        function updateChartStatsMini() {
            const data = profitData.datasets[0].data;
            const totalEl = document.getElementById('totalProfit');
            const avgEl = document.getElementById('avgProfit');
            const growthEl = document.getElementById('growth');
            if (!totalEl || !avgEl || !growthEl || data.length === 0) {
                if(totalEl) totalEl.textContent = '$0';
                if(avgEl) avgEl.textContent = '$0';
                if(growthEl) growthEl.textContent = '0%';
                return;
            }
            const total = data.reduce((sum, val) => sum + val, 0);
            const avg = total / data.length;
            const growth = data.length > 1 && data[0] !== 0 ? ((data[data.length - 1] - data[0]) / data[0] * 100) : 0;
            totalEl.textContent = `$${total.toLocaleString()}`;
            avgEl.textContent = `$${avg.toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;
            growthEl.textContent = `${growth >= 0 ? '+' : ''}${growth.toFixed(1)}%`;
            growthEl.style.color = growth >= 0 ? 'green' : 'red'; 
        }