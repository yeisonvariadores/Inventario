<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class EquiposCiudadChart extends Component
{
    public $chartData = [];

    public function mount()
    {
        $data = DB::table('equipos')
            ->join('ciudades', 'equipos.ciudad_id', '=', 'ciudades.id')
            ->select('ciudades.nombre', DB::raw('count(*) as total'))
            ->groupBy('ciudades.nombre')
            ->pluck('total', 'ciudades.nombre');

        $this->chartData = [
            'labels' => $data->keys(),
            'values' => $data->values(),
        ];
    }

    public function render()
    {
        return view('livewire.charts.equiposCiudad-chart', [
            'chartData' => $this->chartData,
        ]);
    }
}