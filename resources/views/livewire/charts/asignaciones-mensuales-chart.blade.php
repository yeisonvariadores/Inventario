<div class="bg-white dark:bg-neutral-900 p-6 rounded-xl shadow">
    <h2 class="text-lg font-bold mb-4">
        Historial de Asignaciones por Mes
    </h2>

    <div style="height: 350px;">
        <canvas id="asignacionesMensualesChart"></canvas>
    </div>
</div>

@push('scripts')
<script>
    let asignacionesInstance;

    function renderAsignacionesChart() {
        const ctx = document.getElementById('asignacionesMensualesChart');
        if (!ctx) return;

        asignacionesInstance?.destroy();

        asignacionesInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    label: 'Total asignaciones',
                    data: @json($chartData['values']),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }

    document.addEventListener('livewire:load', renderAsignacionesChart);
    document.addEventListener('livewire:navigated', renderAsignacionesChart);
</script>
@endpush