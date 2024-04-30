<div>
    <h1>Productos con menos ingresos del mes</h1>
    <canvas id="lowRevenueProductsChart"></canvas>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const colorPaletteLow = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ];

        const lowRevenueProducts = document.getElementById('lowRevenueProductsChart');
        new Chart(lowRevenueProducts, {
            type: 'bar',
            data: {
                labels: @json($less_revenue->pluck('name')),
                datasets: [{
                    label: 'Bs generados',
                    data: @json($less_revenue->pluck('total_revenue')),
                    backgroundColor: colorPaletteLow,
                    borderColor: colorPaletteLow,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
