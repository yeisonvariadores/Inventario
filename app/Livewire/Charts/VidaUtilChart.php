<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VidaUtilChart extends Component
{
    public $chartData = [];

    public function mount()
    {
        // Forzar meses en español
        DB::statement("SET lc_time_names = 'es_ES'");

        $data = DB::table('asignaciones')
            ->whereNotNull('fecha_devolucion')
            ->selectRaw("
                DATE_FORMAT(fecha_asignacion, '%M %Y') as mes,
                MIN(fecha_asignacion) as fecha_real,
                AVG(TIMESTAMPDIFF(HOUR, fecha_asignacion, fecha_devolucion)) / 24 as promedio_dias
            ")
            ->groupBy('mes')
            ->orderBy('fecha_real')
            ->get();

        $this->chartData = [
            'labels' => $data->pluck('mes'),
            'values' => $data->pluck('promedio_dias')
                            ->map(fn($v) => round($v, 1)),
        ];
    }

    public function render()
    {
        return view('livewire.charts.vida-util-chart', [
            'chartData' => $this->chartData,
        ]);
    }
}