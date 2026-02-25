<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Asignacion;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Models\Estado;
use Flux\Flux;

use function Symfony\Component\Clock\now;

class VerAsignacion extends Component
{
    public $usuario;
    public $asignacion;
    public $asignacionId;


    #[On('ver-asignacion')]
    public function cargarAsignacion($id)
    {
        $this->asignacion = Asignacion::with(['usuario', 'equipo'])
            ->findOrFail($id);

        $this->asignacionId = $this->asignacion->id;

        $this->usuario = $this->asignacion->usuario;

        Flux::modal('ver-asignacion')->show();
    }


    ///////////////////////////////////
    //Desasignar Equipo
    ///////////////////////////////////

    public function confirmarDesasignacion()
    {
        Flux::modal('ver-asignacion')->close();

        $this->dispatch('swal-confirm', [
            'title' => '¿Desasignar equipo?',
            'text' => 'El equipo será marcado como disponible.',
            'icon' => 'warning',
            'confirmButtonText' => 'Sí, desasignar',
            'cancelButtonText' => 'Cancelar',
            'event' => 'confirmar-actualizacion'
        ]);
    }

    #[On('confirmar-actualizacion')]
    public function desasignar()
    {
        if (!$this->asignacionId) {
            return;
        }

        DB::transaction(function () {

            $asignacion = Asignacion::with('equipo')
                ->find($this->asignacionId);

            if (!$asignacion) {
                return;
            }

            $asignacion->update([
                'fecha_devolucion' => now(),
                'updated_at' => now(),
            ]);

            $estadoDisponible = Estado::where('nombre', 'Disponible')->first();

            $asignacion->equipo->update([
                'estado_id' => $estadoDisponible?->id,
            ]);
        });

        $this->dispatch('refresh-inventario');

        Flux::modal('ver-asignacion')->close();

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Equipo actualizado',
            'text' => 'Los cambios se guardaron correctamente',
        ]);
        return redirect()->route('inventario.index');
    }
    ///////////////////////////////////


    public function render()
    {
        return view('livewire.inventario.ver-asignacion');
    }
}
