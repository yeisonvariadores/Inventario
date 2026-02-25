<?php

namespace App\Livewire\Usuario;

use Livewire\Component;
use App\Models\Usuario;
use Flux\Flux;

class ModalCreate extends Component
{
    public $nombre = '';
    public $correo = '';
    public $dni = '';

    //Reglas
    protected $rules = [
        'nombre' => 'required|string|min:3|max:255',
        'correo' => 'required|email|unique:usuarios,correo',
        'dni' => 'required|numeric|min:1|unique:usuarios,dni',
    ];

    //Mensajes de error
    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio.',
        'correo.required' => 'El correo es obligatorio.',
        'correo.email' => 'Debe ser un correo válido.',
        'correo.unique' => 'Este correo ya está registrado.',
        'dni.required' => 'El DNI es obligatorio.',
        'dni.unique' => 'Este DNI ya existe.',
    ];

    public function crearUsuario()
    {
        $this->validate();

        Usuario::create([
            'nombre' => $this->nombre,
            'correo' => $this->correo,
            'dni' => $this->dni,
        ]);

        $this->reset(['nombre', 'correo', 'dni']);

        $this->dispatch('refresh-usuarios');

        Flux::modal('crear-usuario')->close();
        
        $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Usuario Creado',
                'text' => 'El usuario se creo correctamente',
        ]);
    }


    public function render()
    {
        return view('livewire.usuario.modalcreate');
    }
}