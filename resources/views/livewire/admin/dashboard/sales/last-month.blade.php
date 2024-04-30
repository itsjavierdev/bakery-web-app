<div>
    <h1>Ventas del ultimo mes</h1>
    <canvas id="salesLastMonthChart"></canvas>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const salesLastMonth = document.getElementById('salesLastMonthChart').getContext('2d');

        new Chart(salesLastMonth, {
            type: 'line',
            data: {
                labels: @json($last_month->pluck('day')),
                datasets: [{
                    label: 'Ingresos por Día',
                    data: @json($last_month->pluck('total_income')),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 0.5)',
                    borderWidth: 3
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
