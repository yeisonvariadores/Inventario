<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Usuario;
use App\Models\Equipo;
use App\Models\Asignacion;
use Illuminate\Support\Facades\DB;
use Flux\Flux;

class ModalCreate extends Component
{
    public $usuario_id;
    public $equipo_id;

    public $usuarios = [];
    public $equiposDisponibles = [];

    public function mount()
    {
        $this->usuarios = Usuario::orderBy('nombre')->get();

        // Solo equipos con estado Disponible (ej: estado_id = 1)
        $this->equiposDisponibles = Equipo::where('estado_id', 1)->get();
    }

    public function guardarAsignacion()
    {
        $this->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'equipo_id'  => 'required|exists:equipos,id',
        ]);

        // Validar que el equipo NO esté asignado actualmente
        $equipoOcupado = Asignacion::where('equipo_id', $this->equipo_id)
        ->whereNull('fecha_devolucion')
        ->exists();

        if ($equipoOcupado) {
            $this->addError('equipo_id', 'Este equipo ya está asignado a otro usuario.');
            return;
        }

        DB::transaction(function () {

            // 1️⃣ Crear asignación
            Asignacion::create([
                'usuario_id'       => $this->usuario_id,
                'equipo_id'        => $this->equipo_id,
                'fecha_asignacion' => now(),
            ]);

            // 2️⃣ Cambiar estado del equipo a "Asignado"
            Equipo::where('id', $this->equipo_id)
                ->update(['estado_id' => 2]); // 2 = Asignado

        });

        $this->reset([
            'usuario_id',
            'equipo_id'
            ]);

        $this->dispatch('refresh-inventario');

        Flux::modal('create-asignacion')->close();

        $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Equipo asigando correctamente',
                'text' => 'El equipo se registró correctamente',
        ]);

        $this->dispatch('asignacion-creada');
        return redirect()->route('inventario.index');
    }

    public function render()
    {
        return view('livewire.inventario.modalcreate');
    }
}