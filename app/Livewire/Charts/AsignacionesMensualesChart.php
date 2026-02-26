<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AsignacionesMensualesChart extends Component
{
    public $chartData = [];

    public function mount()
    {
        $data = DB::table('asignaciones')
            ->selectRaw("
                DATE_FORMAT(fecha_asignacion, '%Y-%m') as mes,
                COUNT(*) as total
            ")
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $this->chartData = [
            'labels' => $data->pluck('mes'),
            'values' => $data->pluck('total'),
        ];
    }

    public function render()
    {
        return view('livewire.charts.asignaciones-mensuales-chart', [
            'chartData' => $this->chartData,
        ]);
    }
}