 let chart;
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

        const colorThemes = {
            blue: {
                bg: 'rgba(102, 126, 234, 0.2)',
                border: 'rgba(102, 126, 234, 1)'
            },
            green: {
                bg: 'rgba(46, 204, 113, 0.2)',
                border: 'rgba(46, 204, 113, 1)'
            },
            purple: {
                bg: 'rgba(155, 89, 182, 0.2)',
                border: 'rgba(155, 89, 182, 1)'
            },
            orange: {
                bg: 'rgba(230, 126, 34, 0.2)',
                border: 'rgba(230, 126, 34, 1)'
            }
        };

        function initChart() {
            const ctx = document.getElementById('profitChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'line',
                data: profitData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: 'white',
                            bodyColor: 'white',
                            borderColor: 'rgba(102, 126, 234, 1)',
                            borderWidth: 1,
                            cornerRadius: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return `Ganancia: $${context.parsed.y.toLocaleString()}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)',
                                drawBorder: false
                            },
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                },
                                font: {
                                    size: 12
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        }

        function addData() {
            const period = document.getElementById('period').value;
            const profit = parseFloat(document.getElementById('profit').value);

            if (period && !isNaN(profit)) {
                profitData.labels.push(period);
                profitData.datasets[0].data.push(profit);
                
                chart.update();
                updateStats();
                
                // Limpiar inputs
                document.getElementById('period').value = '';
                document.getElementById('profit').value = '';
            } else {
                alert('Por favor, completa todos los campos correctamente.');
            }
        }

        function updateChartType() {
            const type = document.getElementById('chartType').value;
            chart.destroy();
            
            if (type === 'area') {
                profitData.datasets[0].fill = true;
                chart = new Chart(document.getElementById('profitChart'), {
                    type: 'line',
                    data: profitData,
                    options: chart.options
                });
            } else {
                profitData.datasets[0].fill = false;
                chart = new Chart(document.getElementById('profitChart'), {
                    type: type,
                    data: profitData,
                    options: chart.options
                });
            }
        }

        function updateColors() {
            const theme = document.getElementById('colorTheme').value;
            const colors = colorThemes[theme];
            
            profitData.datasets[0].backgroundColor = colors.bg;
            profitData.datasets[0].borderColor = colors.border;
            profitData.datasets[0].pointBackgroundColor = colors.border;
            
            chart.update();
        }

        function updateStats() {
            const data = profitData.datasets[0].data;
            if (data.length === 0) {
                document.getElementById('stats').innerHTML = '';
                return;
            }

            const total = data.reduce((sum, val) => sum + val, 0);
            const avg = total / data.length;
            const max = Math.max(...data);
            const min = Math.min(...data);
            const growth = data.length > 1 ? ((data[data.length - 1] - data[0]) / data[0] * 100) : 0;

            document.getElementById('stats').innerHTML = `
                <div class="stat-card">
                    <div class="stat-value">$${total.toLocaleString()}</div>
                    <div class="stat-label">Ganancia Total</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">$${avg.toLocaleString()}</div>
                    <div class="stat-label">Promedio</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">$${max.toLocaleString()}</div>
                    <div class="stat-label">Máximo</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">${growth.toFixed(1)}%</div>
                    <div class="stat-label">Crecimiento</div>
                </div>
            `;
        }

        function clearData() {
            profitData.labels = [];
            profitData.datasets[0].data = [];
            chart.update();
            updateStats();
        }

        function generateSampleData() {
            const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'];
            const sampleProfits = [15000, 18000, 22000, 19000, 25000, 28000];
            
            profitData.labels = months;
            profitData.datasets[0].data = sampleProfits;
            
            chart.update();
            updateStats();
        }

        // Inicializar la gráfica cuando se carga la página
        window.onload = function() {
            initChart();
            generateSampleData(); // Cargar datos de ejemplo
        };

        // Permitir agregar datos con Enter
        document.getElementById('profit').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                addData();
            }
        });