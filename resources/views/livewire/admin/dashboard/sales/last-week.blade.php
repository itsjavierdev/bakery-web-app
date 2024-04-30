<div>
    <h1>Ventas de la ultima semana</h1>
    <canvas id="salesLastWeekChart"></canvas>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const salesLastWeek = document.getElementById('salesLastWeekChart').getContext('2d');

        new Chart(salesLastWeek, {
            type: 'line',
            data: {
                labels: @json($last_week->pluck('day')),
                datasets: [{
                    label: 'Ingresos por Día',
                    data: @json($last_week->pluck('total_income')),
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 0.5)',
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
