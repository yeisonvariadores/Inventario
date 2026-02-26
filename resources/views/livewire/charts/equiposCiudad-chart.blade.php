<div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4">
    <h2 class="text-sm font-semibold mb-3">
        Equipos por ciudad
    </h2>

    <div wire:ignore class="relative h-64">
        <canvas id="chartEquiposCiudad"></canvas>
    </div>
</div>

@push('scripts')
<script>
    let chartEquiposCiudad;

    function renderChartEquiposCiudad() {
        const canvas = document.getElementById('chartEquiposCiudad');
        if (!canvas) return;

        chartEquiposCiudad?.destroy();

        chartEquiposCiudad = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    label: 'Equipos',
                    data: @json($chartData['values']),
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    document.addEventListener('livewire:load', renderChartEquiposCiudad);
    document.addEventListener('livewire:navigated', renderChartEquiposCiudad);
</script>
@endpush