<div class="bg-white dark:bg-neutral-900 p-6 rounded-xl shadow">
    <h2 class="text-lg font-bold mb-4">
        Curva de Vida Útil Promedio
    </h2>

    <div style="height: 350px;">
        <canvas id="vidaUtilChart"></canvas>
    </div>
</div>

@push('scripts')
<script>
let vidaUtilInstance;

function renderVidaUtilChart() {

    const ctx = document.getElementById('vidaUtilChart');
    if (!ctx) return;

    vidaUtilInstance?.destroy();

    const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 350);
    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.5)');
    gradient.addColorStop(1, 'rgba(59, 130, 246, 0.05)');

    vidaUtilInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartData['labels']),
            datasets: [{
                label: 'Promedio días asignado',
                data: @json($chartData['values']),
                borderColor: '#3b82f6',
                backgroundColor: gradient,
                borderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.raw + ' días promedio';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' días';
                        }
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 0,
                        minRotation: 0
                    }
                }
            }
        }
    });
}

document.addEventListener('livewire:load', renderVidaUtilChart);
document.addEventListener('livewire:navigated', renderVidaUtilChart);
</script>
@endpush