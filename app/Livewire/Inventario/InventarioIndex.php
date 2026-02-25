<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Asignacion;
use Livewire\Attributes\On;

class InventarioIndex extends Component
{
    use WithPagination;

    public $buscarAsignacion = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'ASC';
    public $usuarioSeleccionado;
    public $asignacionSeleccionada;


    #[On('refresh-inventario')]
    public function refreshInventario()
    {
    }

    public function updatingBuscarAsignacion()
    {
        $this->resetPage();
    }


    public $sortTable = [
        'id' => 'asignaciones.id',
        'created_at' => 'asignaciones.created_at',
        'marca' => 'equipos.marca',
        'modelo' => 'equipos.modelo',
        'serial' => 'equipos.serial',
        'usuario' => 'usuarios.nombre',
    ];
    public function setSortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection =
                $this->sortDirection === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'ASC';
        }
        $this->resetPage(); // 🔥 importante cuando usas paginación
    }

    public function render()
    {
        $query = Asignacion::query()
            ->select('asignaciones.*')
            ->whereNull('fecha_devolucion')
            ->buscarAsignacion($this->buscarAsignacion);

        // 🔥 Obtener columna real a ordenar
        $column = $this->sortTable[$this->sortBy] ?? 'asignaciones.id';

        // 🔥 Join dinámico según tabla
        if (str_contains($column, 'equipos.')) {
            $query->join('equipos', 'equipos.id', '=', 'asignaciones.equipo_id');
        }

        if (str_contains($column, 'usuarios.')) {
            $query->join('usuarios', 'usuarios.id', '=', 'asignaciones.usuario_id');
        }

        // 🔥 Aplicar orden
        $query->orderBy($column, $this->sortDirection);

        // 🔥 Evitar duplicados cuando hay joins
        $query->distinct();

        // 🔥 Cargar relaciones correctamente
        $query->with(['usuario', 'equipo']);

        $asignaciones = $query->paginate(8);

        return view('livewire.inventario.index', compact('asignaciones'));
    }
}