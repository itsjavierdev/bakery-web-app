<div>
    <h1>Productos menos vendidos</h1>
    <canvas id="productsLessChart"></canvas>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const colorPaletteLess = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ];

        const productsLess = document.getElementById('productsLessChart');

        new Chart(productsLess, {
            type: 'bar',
            data: {
                labels: @json($less_sellers->pluck('name')),
                datasets: [{
                    label: '# Unidades vendidas',
                    data: @json($less_sellers->pluck('total_sold')),
                    backgroundColor: colorPaletteLess,
                    borderColor: colorPaletteLess,
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
