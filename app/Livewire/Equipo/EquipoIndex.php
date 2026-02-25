<?php

namespace App\Livewire\Equipo;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Equipo;

class EquipoIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $buscarEquipos = '';
    public $sortBy = 'id';
    public $sortDirection = 'asc';

    // =========================
    // RESET PAGINACIÓN AL BUSCAR
    // =========================
    public function updatingBuscarEquipos()
    {
        $this->resetPage();
    }

    // =========================
    // ORDENAMIENTO
    // =========================
    public function setSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection =
                $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortBy = $field;
    }

    // =========================
    // RENDER
    // =========================
    public function render()
    {
        $equipos = Equipo::with(['estado', 'ciudad'])
            ->when($this->buscarEquipos, function ($query) {
                $query->where(function ($q) {
                    $q->where('marca', 'like', "%{$this->buscarEquipos}%")
                      ->orWhere('modelo', 'like', "%{$this->buscarEquipos}%")
                      ->orWhere('serial', 'like', "%{$this->buscarEquipos}%")
                      ->orWhere('activo_fijo', 'like', "%{$this->buscarEquipos}%")
                      ->orWhere('sistema_operativo', 'like', "%{$this->buscarEquipos}%");
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(8);

        return view('livewire.equipo.index', compact('equipos'));
    }
}