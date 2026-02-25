<?php

namespace App\Livewire\Equipos;

use App\Models\Ciudad;
use Livewire\Component;
use App\Models\Estado;
use Flux\Flux;
use App\Models\Equipos;
use Illuminate\Validation\Rule;

/**
 * Componente Livewire
 * -------------------
 * ModalCreate
 *
 * Este componente se encarga de:
 * - Mostrar un modal para crear un nuevo equipo
 * - Validar los datos ingresados
 * - Guardar el equipo en la base de datos
 * - Cerrar el modal y notificar a otros componentes
 */
class ModalCreate extends Component
{

    

    /**
     * ============================
     * MÉTODO: render
     * ============================
     * - Retorna la vista del modal
     * - Envía los estados disponibles al formulario
     */
    public function render()
    {
        return view('livewire.equipos.modal-create', [
            'estados' => Estado::all(),
            'ciudades' => Ciudad::all(),
        ]);
    }
}