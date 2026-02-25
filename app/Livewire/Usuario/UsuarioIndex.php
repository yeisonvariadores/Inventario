<?php

namespace App\Livewire\Usuario;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Usuario;
use Livewire\Attributes\On;

class UsuarioIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $buscarUsuario = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'ASC';

    #[On('refresh-usuarios')]
    public function refreshUsuarios()
    {
    }

    protected array $sortTable = [
        'id' => 'usuarios.id',
        'nombre' => 'usuarios.nombre',
        'correo' => 'usuarios.correo',
        'dni' => 'usuarios.dni',
        'created_at' => 'usuarios.created_at'
    ];

    public function updatingBuscarUsuario($property)
    {
        if ($property === 'buscarUsuario') {
            $this->resetPage();
        }
    }

    public function setSortBy(string $field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'ASC';
        }

        $this->resetPage();
    }

    public function render()
    {
        $query = Usuario::query()
            ->buscarUsuario($this->buscarUsuario);
        //CONFIGURACIÓN DE FILTROS Y ORDENAMIENTO
        if (isset($this->sortTable[$this->sortBy])) {
            $query->orderBy(
                $this->sortTable[$this->sortBy],
                $this->sortDirection
            );
        }
        //------------------------------------------

        return view('livewire.usuario.index', [
            'usuarios' => $query->paginate(8),
        ]);
    }
}

